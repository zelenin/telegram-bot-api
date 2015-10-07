<?php

namespace Zelenin\Telegram\Bot\Daemon;

interface DaemonInterface
{
    public function run();

    /**
     * @param callable $callback
     */
    public function onUpdate(callable $callback);
}
