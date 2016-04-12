<?php

namespace Zelenin\Telegram\Bot\Daemon;

use Generator;
use InvalidArgumentException;
use Zelenin\Telegram\Bot\Api;
use Zelenin\Telegram\Bot\Type\Update;

final class NaiveDaemon implements Daemon
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var callable
     */
    private $updateCallback;

    /**
     * @param Api $api
     * @param int $offset
     * @param int $timeout
     */
    public function __construct(Api $api, $offset = 0, $timeout = 1)
    {
        $this->api = $api;
        $this->offset = (int)$offset;
        $this->timeout = (int)$timeout;
    }

    public function run()
    {
        if (!is_callable($this->updateCallback)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a callable function. Set it via "%s".', 'updateCallback', 'onUpdate'));
        }

        while (true) {
            foreach ($this->getUpdates() as $update) {
                $this->runCallback($update);
                $this->incrementOffset($update);
            }

            $this->handleSignals();

            sleep($this->timeout);
        }
    }

    /**
     * @return Generator
     */
    private function getUpdates()
    {
        $updates = $this->api->getUpdates(['offset' => $this->offset]);
        foreach ($updates as $update) {
            yield $update;
        }
    }

    /**
     * @param callable $callback
     *
     * @return $this
     */
    public function onUpdate(callable $callback)
    {
        $this->updateCallback = $callback;
        return $this;
    }

    /**
     * @param Update $update
     */
    private function runCallback(Update $update)
    {
        call_user_func($this->updateCallback, $update);
    }

    /**
     * @param Update $update
     */
    private function incrementOffset(Update $update)
    {
        if ($update->update_id >= $this->offset) {
            $this->offset = $update->update_id + 1;
        }
    }

    private function handleSignals()
    {
        declare(ticks = 1);

        pcntl_signal(SIGINT, function ($signal) {
            switch ($signal) {
                case SIGINT:
                    exit(0);
                    break;
            }
        });
    }
}
