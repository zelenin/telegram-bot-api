<?php

namespace Zelenin\Telegram\Bot\Type;

final class Venue extends Type
{
    /**
     * Venue location
     *
     * @var Location
     */
    public $location;

    /**
     * Name of the venue
     *
     * @var string
     */
    public $title;

    /**
     * Address of the venue
     *
     * @var string
     */
    public $address;

    /**
     * Optional. Foursquare identifier of the venue
     *
     * @var string
     */
    public $foursquare_id;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['location'])) {
            $this->location = Location::create($attributes['location']);
        }
    }
}
