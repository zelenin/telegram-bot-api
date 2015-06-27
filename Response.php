<?php

namespace Zelenin\Telegram\Bot;

use stdClass;

class Response
{
    /**
     * @var boolean
     */
    private $ok;
    /**
     * @var stdClass
     */
    private $result;

    /**
     * @param $ok
     * @param $result
     */
    public function __construct($ok, $result)
    {
        $this->ok = (bool)$ok;
        $this->result = $result;
    }

    /**
     * @return boolean
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * @return mixed|stdClass
     */

    public function getResult()
    {
        return $this->result;
    }
}
