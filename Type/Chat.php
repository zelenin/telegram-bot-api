<?php

namespace Zelenin\Telegram\Bot\Type;

final class Chat extends Type
{
    /**
     * Unique identifier for this chat, not exceeding 1e13 by absolute value
     *
     * @var int
     */
    public $id;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     *
     * @var string
     */
    public $type;

    /**
     * Optional. Title, for channels and group chats
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Username, for private chats and channels if available
     *
     * @var string
     */
    public $username;

    /**
     * Optional. First name of the other party in a private chat
     *
     * @var string
     */
    public $first_name;

    /**
     * Optional. Last name of the other party in a private chat
     *
     * @var string
     */
    public $last_name;
}
