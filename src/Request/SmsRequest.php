<?php

namespace MobilniPlatby\Request;

use MobilniPlatby\RequestException;

/**
 * Info request
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class SmsRequest extends AbstractRequest
{

    /** OPERATORS */
    const OPERATOR_TMOBILE = "TMOBILE";
    const OPERATOR_O2 = "O2";
    const OPERATOR_VODAFONE = "VODAFONE";
    const OPERATOR_ORANGE = "ORANGE";

    /** @var string */
    protected $operator;

    /** @var string */
    protected $country;

    /** @var string */
    protected $shortcode;

    /** @var string */
    protected $text;

    /** @var string */
    protected $phone;

    /**
     * @param int $id
     * @param int $phone
     * @param int $shortcode
     * @param string $text
     * @param mixed $timestamp
     * @param string $operator
     * @param string $country
     * @param int $att
     */
    function __construct($id, $phone, $shortcode, $text, $timestamp, $operator, $country, $att)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->shortcode = $shortcode;
        $this->text = $text;
        $this->setTimestamp($timestamp);
        $this->setOperator($operator);
        $this->att = $att;
        $this->country = $country;
    }

    /** GETTERS/SETTERS ***************************************************** */

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $operator
     * @throws RequestException
     */
    protected function setOperator($operator)
    {
        switch ($operator) {
            case self::OPERATOR_O2:
                $this->operator = self::OPERATOR_O2;
                break;
            case self::OPERATOR_ORANGE:
                $this->operator = self::OPERATOR_ORANGE;
                break;
            case self::OPERATOR_TMOBILE:
                $this->operator = self::OPERATOR_TMOBILE;
                break;
            case self::OPERATOR_VODAFONE:
                $this->operator = self::OPERATOR_VODAFONE;
                break;
            default:
                throw new RequestException("Request: Uknown operator '$operator'.");
        }
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getShortcode()
    {
        return $this->shortcode;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return self::TYPE_SMS;
    }
}
