<?php

namespace Zelenin\Telegram\Bot\Client;

interface Client
{
    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, array $params = []);
}
