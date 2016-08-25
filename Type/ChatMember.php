<?php

namespace Zelenin\Telegram\Bot\Type;

final class ChatMember extends Type
{
    /**
     * Information about the user
     *
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat. Can be “creator”, “administrator”, “member”, “left” or “kicked”
     *
     * @var string
     */
    public $status;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['user'])) {
            $this->user = User::create($attributes['user']);
        }
    }
}
