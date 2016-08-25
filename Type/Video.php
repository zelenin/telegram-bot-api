<?php

namespace Zelenin\Telegram\Bot\Type;

final class Video extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Video width as defined by sender
     *
     * @var integer
     */
    public $width;

    /**
     * Video height as defined by sender
     *
     * @var integer
     */
    public $height;

    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var integer
     */
    public $duration;

    /**
     * Optional. Video thumbnail
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Mime type of a file as defined by sender
     *
     * @var string
     */
    public $mime_type;

    /**
     * Optional. File size
     *
     * @var integer
     */
    public $file_size;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['thumb'])) {
            $this->thumb = PhotoSize::create($attributes['thumb']);
        }
    }
}
