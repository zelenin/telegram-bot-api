<?php

namespace Zelenin\Telegram\Bot\Type\Inline;

use Zelenin\Telegram\Bot\Type\Location;
use Zelenin\Telegram\Bot\Type\Type;
use Zelenin\Telegram\Bot\Type\User;

final class InlineQuery extends Type
{
    /**
     * Unique identifier for this query
     *
     * @var string
     */
    public $id;

    /**
     * Sender
     *
     * @var User
     */
    public $from;

    /**
     * Optional. Sender location, only for bots that require user location
     *
     * @var Location
     */
    public $location;

    /**
     * Text of the query
     *
     * @var string
     */
    public $query;

    /**
     * Offset of the results to be returned, can be controlled by the bot
     *
     * @var string
     */
    public $offset;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['from'])) {
            $this->from = User::create($attributes['from']);
        }

        if (isset($attributes['location'])) {
            $this->location = Location::create($attributes['location']);
        }
    }
}
