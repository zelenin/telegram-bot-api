<?php

namespace Zelenin\Telegram\Bot\Type;

final class Location extends Type
{
    /**
     * Longitude as defined by sender
     *
     * @var float
     */
    public $longitude;

    /**
     * Latitude as defined by sender
     *
     * @var float
     */
    public $latitude;
}
