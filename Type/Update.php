<?php

namespace Zelenin\Telegram\Bot\Type;

use Zelenin\Telegram\Bot\Type\Inline\ChosenInlineResult;
use Zelenin\Telegram\Bot\Type\Inline\InlineQuery;

final class Update extends Type
{
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order.
     *
     * @var integer
     */
    public $update_id;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     *
     * @var Message
     */
    public $message;

    /**
     * Optional. New version of a message that is known to the bot and was edited
     *
     * @var Message
     */
    public $edited_message;

    /**
     * Optional. New incoming inline query
     *
     * @var InlineQuery
     */
    public $inline_query;

    /**
     * Optional. The result of an inline query that was chosen by a user and sent to their chat partner.
     *
     * @var ChosenInlineResult
     */
    public $chosen_inline_result;

    /**
     * Optional. New incoming callback query
     *
     * @var CallbackQuery
     */
    public $callback_query;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['message'])) {
            $this->message = Message::create($attributes['message']);
        }

        if (isset($attributes['edited_message'])) {
            $this->edited_message = Message::create($attributes['edited_message']);
        }

        if (isset($attributes['inline_query'])) {
            $this->inline_query = InlineQuery::create($attributes['inline_query']);
        }

        if (isset($attributes['chosen_inline_result'])) {
            $this->chosen_inline_result = ChosenInlineResult::create($attributes['chosen_inline_result']);
        }

        if (isset($attributes['callback_query'])) {
            $this->callback_query = CallbackQuery::create($attributes['callback_query']);
        }
    }
}
