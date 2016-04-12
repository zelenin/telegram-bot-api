<?php

namespace Zelenin\Telegram\Bot\Type;

final class UserProfilePhotos extends Type
{
    /**
     * Total number of profile pictures the target user has
     *
     * @var integer
     */
    public $total_count;

    /**
     * Requested profile pictures (in up to 4 sizes each)
     *
     * @var PhotoSize[][]
     */
    public $photos;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        $this->photos = [];

        if ($attributes['total_count'] > 0) {
            $this->photos = array_map(function ($photo) {
                return new PhotoSize($photo);
            }, $attributes['photos'][0]);
        }
    }
}
