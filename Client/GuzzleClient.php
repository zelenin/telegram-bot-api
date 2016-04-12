<?php

namespace Zelenin\Telegram\Bot\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use HttpRuntimeException;
use Zelenin\Telegram\Bot\Exception\NotOkException;

final class GuzzleClient implements Client
{
    /**
     * @var string
     */
    private $baseUrl = 'https://api.telegram.org/bot{token}/{method}';

    /**
     * @var string
     */
    private $token;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        if (!is_string($token)) {
            throw new \InvalidArgumentException('Token must be a string.');
        }
        $this->token = $token;
    }

    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, array $params = [])
    {
        $client = new \GuzzleHttp\Client();

        $multipartParams = [];
        foreach ($params as $key => $value) {
            $multipartParams[] = [
                'name' => $key,
                'contents' => is_scalar($value) ? (string)$value : $value
            ];
        }

        try {
            $response = $client->post($this->getUrl($method), [
                'verify' => false,
                'multipart' => $multipartParams ?: null
            ]);
            $response = json_decode($response->getBody());

            if ($response === null) {
                throw new HttpRuntimeException('Empty response.');
            }
            return new Response($response->ok, $response->result);
        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            return new Response($response->ok, null, $response->error_code, $response->description);
        } catch (ServerException $e) {
            return new Response(false, null, $e->getResponse()->getStatusCode(), $e->getResponse()->getReasonPhrase());
        }
    }

    /**
     * @param string $method
     *
     * @return string
     */
    private function getUrl($method)
    {
        return strtr($this->baseUrl, [
            '{token}' => $this->token,
            '{method}' => $method
        ]);
    }
}
