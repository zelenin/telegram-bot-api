<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;
use Zelenin\Telegram\Bot\Client\Response;

abstract class Type
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->load($attributes);
        $this->loadRelated($attributes);
    }

    /**
     * @param array $attributes
     */
    private function load(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param array $attributes
     */
    protected function loadRelated(array $attributes)
    {
    }

    /**
     * @param Response $response
     *
     * @return static
     */
    public static function createFromResponse(Response $response)
    {
        return static::create($response->getResult());
    }

    /**
     * @param stdClass $object
     *
     * @return static
     */
    public static function create(stdClass $object)
    {
        return new static((array)$object);
    }
}
