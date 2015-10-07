<?php

namespace Zelenin\Telegram\Bot\Type;

class File extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Optional. File size, if known
     *
     * @var Integer
     */
    public $file_size;

    /**
     * Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
     *
     * @var string
     */
    public $file_path;
}
