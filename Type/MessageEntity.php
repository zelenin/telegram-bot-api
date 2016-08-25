<?php

namespace Zelenin\Telegram\Bot\Type;

final class MessageEntity extends Type
{
    /**
     * Type of the entity. One of mention (@username), hashtag, bot_command, url, email, bold (bold text), italic (italic text), code (monowidth string), pre (monowidth block), text_link (for clickable text URLs)
     *
     * @var string
     */
    public $type;

    /**
     * Offset in UTF-16 code units to the start of the entity
     *
     * @var int
     */
    public $offset;

    /**
     * Length of the entity in UTF-16 code units
     *
     * @var int
     */
    public $length;

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text
     *
     * @var string
     */
    public $url;

    /**
     * Optional. For “text_mention” only, the mentioned user
     *
     * @var User
     */
    public $user;

    /**
     * @inheritdoc
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['user'])) {
            $this->user = User::create($attributes['user']);
        }
    }
}
