<?php

namespace Zelenin\Telegram\Bot\Type;

final class ReplyKeyboardMarkup extends ReplyMarkup
{
    /**
     * Array of button rows, each represented by an Array of KeyboardButton objects
     *
     * @var KeyboardButton[][]
     */
    public $keyboard;

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     *
     * @var boolean
     */
    public $resize_keyboard = false;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     *
     * @var boolean
     */
    public $one_time_keyboard = false;
}
