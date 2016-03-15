<?php

namespace Zelenin\Telegram\Bot\Daemon;

use Generator;
use Zelenin\Telegram\Bot\Api;
use Zelenin\Telegram\Bot\Exception\NotCallableException;
use Zelenin\Telegram\Bot\Type\Update;

class Daemon implements DaemonInterface
{
    /**
     * @var Api
     */
    private $client;

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
     * @param Api $client
     * @param int $offset
     * @param int $timeout
     */
    public function __construct(Api $client, $offset = 0, $timeout = 1000)
    {
        $this->client = $client;
        $this->offset = (int)$offset;
        $this->timeout = (int)$timeout;
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        if (!is_callable($this->updateCallback)) {
            throw new NotCallableException(sprintf('"%s" is not a callable function. Set it via "%s".', 'updateCallback', 'onUpdate'));
        }

        \Amp\run(function () {
            \Amp\onSignal(SIGINT, function () {
                \Amp\stop();
            });

            \Amp\repeat(function () {
                foreach ($this->getUpdates() as $update) {
                    $this->runCallback($update);
                    $this->incrementOffset($update);
                }
            }, $this->getTimeout());
        });
    }

    /**
     * @return Generator
     */
    private function getUpdates()
    {
        $updates = $this->getClient()->getUpdates(['offset' => $this->getOffset()]);
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
     * @param callable $callback
     *
     * @return $this
     */
    public function onError(callable $callback)
    {
        $this->errorCallback = $callback;
        return $this;
    }

    /**
     * @return Api
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    private function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @return callable
     */
    private function getUpdateCallback()
    {
        return $this->updateCallback;
    }

    /**
     * @param Update $update
     *
     * @return mixed
     */
    private function runCallback(Update $update)
    {
        return call_user_func($this->getUpdateCallback(), $update);
    }

    /**
     * @param Update $update
     */
    private function incrementOffset(Update $update)
    {
        if ($update->update_id >= $this->getOffset()) {
            $this->offset = $update->update_id + 1;
        }
    }
}
