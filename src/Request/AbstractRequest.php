<?php

namespace MobilniPlatby\Request;

use Nette\Utils\DateTime;

/**
 * Abstract request
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
abstract class AbstractRequest
{

    /** Request types */
    const TYPE_SMS = 1;
    const TYPE_CONFIRM = 2;

    /** @var int */
    protected $id;

    /** @var int */
    protected $att;

    /** @var DateTime */
    protected $timestamp;

    /** GETTERS/SETTERS ***************************************************** */

    /**
     * @return int
     */
    public function getAtt()
    {
        return $this->att;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $timestamp
     */
    protected function setTimestamp($timestamp)
    {
        $this->timestamp = DateTime::from(strtotime($timestamp));
    }

    /**
     * @return DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /** ABSTRACT METHODS **************************************************** */

    /**
     * @return int
     */
    abstract function getType();

}
