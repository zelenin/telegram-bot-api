<?php

namespace Zelenin\Telegram\Bot\Type;

final class InlineKeyboardMarkup extends Type
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     *
     * @var InlineKeyboardButton[][]
     */
    public $inline_keyboard;
}
