<?php

namespace MobilniPlatby\Request;

use MobilniPlatby\RequestException;

/**
 * Confirm request
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class ConfirmRequest extends AbstractRequest
{

    /** MESSAGES */
    const MESSAGE_NOT_ENOUGHT_CREDIT = "NOT_ENOUGHT_CREDIT";
    const MESSAGE_INVALID_OPERATOR = "INVALID_OPERATOR";
    const MESSAGE_SERVICE_NOT_ALLOWED = "SERVICE_NOT_ALLOWED";
    const MESSAGE_SERVICE_BLOCKED = "SERVICE_BLOCKED";
    const MESSAGE_USAGE_RATE_EXCEEDED = "USAGE_RATE_EXCEEDED";
    const MESSAGE_MT_SERVICE_NOT_ALLOWED = "MT_SERVICE_NOT_ALLOWED";
    const MESSAGE_CUSTOMER_BLOCKED = "CUSTOMER_BLOCKED";
    const MESSAGE_DAILY_LIMIT_EXCEEDE = "DAILY_LIMIT_EXCEEDED";
    const MESSAGE_INTERNAL_ERROR = "INTERNAL_ERROR";
    const MESSAGE_INFO_NOT_AVAILABLEE = "INFO_NOT_AVAILABLE";

    /** STATUSES */
    const STATUS_DELIVERED = "DELIVERED";
    const STATUS_UNDELIVERED = "UNDELIVERED";
    const STATUS_PENDING = "PENDING";
    const STATUS_WAITING = "WAITING";
    const STATUS_UNKNOWN = "UNKNOWN";

    /** @var int */
    protected $request;

    /** @var string */
    protected $status;

    /** @var string */
    protected $message;

    /**
     * @param int $id
     * @param int $request
     * @param string $message
     * @param string $status
     * @param mixed $timestamp
     * @param int $att
     */
    function __construct($id, $request, $message, $status, $timestamp, $att)
    {
        $this->id = $id;
        $this->request = $request;
        $this->setMessage($message);
        $this->setStatus($status);
        $this->setTimestamp($timestamp);
        $this->att = $att;
    }

    /** GETTERS/SETTERS ***************************************************** */

    /**
     * @param string $message
     * @throws RequestException
     */
    protected function setMessage($message)
    {
        switch ($message) {
            case self::MESSAGE_CUSTOMER_BLOCKED:
                $this->message = self::MESSAGE_CUSTOMER_BLOCKED;
                break;
            case self::MESSAGE_DAILY_LIMIT_EXCEEDE:
                $this->message = self::MESSAGE_DAILY_LIMIT_EXCEEDE;
                break;
            case self::MESSAGE_INFO_NOT_AVAILABLEE:
                $this->message = self::MESSAGE_INFO_NOT_AVAILABLEE;
                break;
            case self::MESSAGE_INTERNAL_ERROR:
                $this->message = self::MESSAGE_INTERNAL_ERROR;
                break;
            case self::MESSAGE_INVALID_OPERATOR:
                $this->message = self::MESSAGE_INVALID_OPERATOR;
                break;
            case self::MESSAGE_MT_SERVICE_NOT_ALLOWED:
                $this->message = self::MESSAGE_MT_SERVICE_NOT_ALLOWED;
                break;
            case self::MESSAGE_NOT_ENOUGHT_CREDIT:
                $this->message = self::MESSAGE_NOT_ENOUGHT_CREDIT;
                break;
            case self::MESSAGE_SERVICE_BLOCKED:
                $this->message = self::MESSAGE_SERVICE_BLOCKED;
                break;
            case self::MESSAGE_SERVICE_NOT_ALLOWED:
                $this->message = self::MESSAGE_SERVICE_NOT_ALLOWED;
                break;
            case self::MESSAGE_USAGE_RATE_EXCEEDED:
                $this->message = self::MESSAGE_USAGE_RATE_EXCEEDED;
                break;
            default:
                $this->message = $message;
                //throw new RequestException("Request: Uknown message '$message'.");
        }
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $status
     * @throws RequestException
     */
    protected function setStatus($status)
    {
        switch ($status) {
            case self::STATUS_DELIVERED:
                $this->status = self::STATUS_DELIVERED;
                break;
            case self::STATUS_PENDING:
                $this->status = self::STATUS_PENDING;
                break;
            case self::STATUS_UNDELIVERED:
                $this->status = self::STATUS_UNDELIVERED;
                break;
            case self::STATUS_UNKNOWN:
                $this->status = self::STATUS_UNKNOWN;
                break;
            case self::STATUS_WAITING:
                $this->status = self::STATUS_WAITING;
                break;
            default:
                throw new RequestException("Request: Uknown status '$status'.");
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return self::TYPE_CONFIRM;
    }
}