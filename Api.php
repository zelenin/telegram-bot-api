<?php

namespace Zelenin\Telegram\Bot;

use stdClass;
use Zelenin\Telegram\Bot\Client\Client;
use Zelenin\Telegram\Bot\Client\Response;
use Zelenin\Telegram\Bot\Exception\NotOkException;
use Zelenin\Telegram\Bot\Type\File;
use Zelenin\Telegram\Bot\Type\Message;
use Zelenin\Telegram\Bot\Type\ReplyMarkup;
use Zelenin\Telegram\Bot\Type\Update;
use Zelenin\Telegram\Bot\Type\User;
use Zelenin\Telegram\Bot\Type\UserProfilePhotos;

final class Api
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, array $params = [])
    {
        $response = $this->client->request($method, $params);
        if (!$response->getOk()) {
            throw new NotOkException(sprintf('Code: %s. Description: "%s".',$response->getErrorCode(), $response->getDescription()));
        }
        return $response;
    }

    /**
     * @return User
     */
    public function getMe()
    {
        return User::createFromResponse($this->request('getMe'));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendMessage(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendMessage', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function forwardMessage($params)
    {
        return Message::createFromResponse($this->request('forwardMessage', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendPhoto($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendPhoto', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendAudio($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendAudio', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendDocument($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendDocument', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendSticker($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendSticker', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendVideo($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendVideo', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendVoice($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendVideo', $params));
    }

    /**
     * @param $params
     *
     * @return Message
     *
     * @throws NotOkException
     */
    public function sendLocation($params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof ReplyMarkup) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }
        return Message::createFromResponse($this->request('sendLocation', $params));
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function sendChatAction(array $params)
    {
        return $this->request('sendChatAction', $params);
    }

    /**
     * @param $params
     *
     * @return UserProfilePhotos
     *
     * @throws NotOkException
     */
    public function getUserProfilePhotos($params)
    {
        return UserProfilePhotos::createFromResponse($this->request('getUserProfilePhotos', $params));
    }

    /**
     * @param $params
     *
     * @return File
     *
     * @throws NotOkException
     */
    public function getFile($params)
    {
        return File::createFromResponse($this->request('getFile', $params));
    }

    /**
     * @param $params
     *
     * @return Update[]
     *
     * @throws NotOkException
     */
    public function getUpdates($params)
    {
        return array_map(function (stdClass $item) {
            return Update::createFromResponse($item);
        }, $this->request('getUpdates', $params));
    }

    /**
     * @param $params
     *
     * @return mixed
     *
     * @throws NotOkException
     */
    public function setWebhook($params)
    {
        return $this->request('setWebhook', $params);
    }
}
