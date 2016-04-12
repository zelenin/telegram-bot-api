<?php

namespace Zelenin\Telegram\Bot\Type;

final class KeyboardButton extends Type
{
    /**
     * Text of the button. If none of the optional fields are used, it will be sent to the bot as a message when the button is pressed
     *
     * @var string
     */
    public $text;

    /**
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
     *
     * @var bool
     */
    public $request_contact;

    /**
     * Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
     *
     * @var bool
     */
    public $request_location;
}
