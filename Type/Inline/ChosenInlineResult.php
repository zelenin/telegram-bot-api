<?php

namespace Zelenin\Telegram\Bot\Type\Inline;

use Zelenin\Telegram\Bot\Type\Location;
use Zelenin\Telegram\Bot\Type\Type;
use Zelenin\Telegram\Bot\Type\User;

final class ChosenInlineResult extends Type
{
    /**
     * The unique identifier for the result that was chosen
     *
     * @var string
     */
    public $result_id;

    /**
     * The user that chose the result
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
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     *
     * @var string
     */
    public $inline_message_id;

    /**
     * The query that was used to obtain the result
     *
     * @var string
     */
    public $query;

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
