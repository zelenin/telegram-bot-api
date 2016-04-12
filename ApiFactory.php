<?php

namespace Zelenin\Telegram\Bot;

use Zelenin\Telegram\Bot\Client\GuzzleClient;

final class ApiFactory
{
    /**
     * @param string $token
     *
     * @return Api
     */
    public static function create($token)
    {
        return new Api(new GuzzleClient($token));
    }
}
