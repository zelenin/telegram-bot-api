<?php

namespace Zelenin\Telegram\Bot\Type;

final class Audio extends Type
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    public $file_id;

    /**
     * Duration of the audio in seconds as defined by sender
     *
     * @var integer
     */
    public $duration;

    /**
     * Optional. Performer of the audio as defined by sender or by audio tags
     *
     * @var string
     */
    public $performer;

    /**
     * Optional. Title of the audio as defined by sender or by audio tags
     *
     * @var string
     */
    public $title;

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
}
