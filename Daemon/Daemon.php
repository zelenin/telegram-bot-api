<?php

namespace Zelenin\Telegram\Bot\Daemon;

interface Daemon
{
    public function run();

    /**
     * @param callable $callback
     */
    public function onUpdate(callable $callback);
}
