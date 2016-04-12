<?php

namespace Zelenin\Telegram\Bot\Type;

final class Document extends Type
{
    /**
     * Unique file identifier
     *
     * @var string
     */
    public $file_id;

    /**
     * Optional. Document thumbnail as defined by sender
     *
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Original filename as defined by sender
     *
     * @var string
     */
    public $file_name;

    /**
     * Optional. MIME type of the file as defined by sender
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
