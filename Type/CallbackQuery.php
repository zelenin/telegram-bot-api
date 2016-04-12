<?php

namespace Zelenin\Telegram\Bot\Type;

final class CallbackQuery extends Type
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
     * Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
     *
     * @var Message
     */
    public $message;

    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query
     *
     * @var string
     */
    public $inline_message_id;

    /**
     * Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field
     *
     * @var string
     */
    public $data;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['from'])) {
            $this->from = User::create($attributes['from']);
        }

        if (isset($attributes['message'])) {
            $this->message = Message::create($attributes['message']);
        }
    }
}
