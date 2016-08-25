<?php

namespace Zelenin\Telegram\Bot\Type;

final class Sticker extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Sticker width
     *
     * @var integer
     */
    public $width;

    /**
     * Sticker height
     *
     * @var integer
     */
    public $height;

    /**
     * Optional. Sticker thumbnail in .webp or .jpg format
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Emoji associated with the sticker
     *
     * @var string
     */
    public $emoji;

    /**
     * Optional. File size
     *
     * @var integer
     */
    public $file_size;

    /**
     * @inheritdoc
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['thumb'])) {
            $this->thumb = PhotoSize::create($attributes['thumb']);
        }
    }
}
