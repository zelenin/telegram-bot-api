<?php

namespace Zelenin\Telegram\Bot\Type;

use stdClass;

class UserProfilePhotos extends Type
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
     * @param stdClass $result
     */
    public function loadResult(stdClass $result)
    {
        parent::loadResult($result);

        $this->photos = [];

        if ($result->total_count > 0) {
            $this->photos = array_map(function ($photo) {
                return new PhotoSize($photo);
            }, $result->photos[0]);
        }
    }
}
