<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Request;

use Contributte\MobilniPlatby\RequestException;

class ConfirmRequest extends AbstractRequest
{

	public const MESSAGE_NOT_ENOUGHT_CREDIT = 'NOT_ENOUGHT_CREDIT';
	public const MESSAGE_INVALID_OPERATOR = 'INVALID_OPERATOR';
	public const MESSAGE_SERVICE_NOT_ALLOWED = 'SERVICE_NOT_ALLOWED';
	public const MESSAGE_SERVICE_BLOCKED = 'SERVICE_BLOCKED';
	public const MESSAGE_USAGE_RATE_EXCEEDED = 'USAGE_RATE_EXCEEDED';
	public const MESSAGE_MT_SERVICE_NOT_ALLOWED = 'MT_SERVICE_NOT_ALLOWED';
	public const MESSAGE_CUSTOMER_BLOCKED = 'CUSTOMER_BLOCKED';
	public const MESSAGE_DAILY_LIMIT_EXCEEDE = 'DAILY_LIMIT_EXCEEDED';
	public const MESSAGE_INTERNAL_ERROR = 'INTERNAL_ERROR';
	public const MESSAGE_INFO_NOT_AVAILABLEE = 'INFO_NOT_AVAILABLE';

	public const STATUS_DELIVERED = 'DELIVERED';
	public const STATUS_UNDELIVERED = 'UNDELIVERED';
	public const STATUS_PENDING = 'PENDING';
	public const STATUS_WAITING = 'WAITING';
	public const STATUS_UNKNOWN = 'UNKNOWN';

	/** @var int */
	protected $request;

	/** @var string */
	protected $status;

	/** @var string */
	protected $message;

	public function __construct(int $id, int $request, string $message, string $status, int $timestamp, int $att)
	{
		$this->id = $id;
		$this->request = $request;
		$this->setMessage($message);
		$this->setStatus($status);
		$this->setTimestamp($timestamp);
		$this->att = $att;
	}

	/**
	 * @throws RequestException
	 */
	protected function setMessage(string $message): void
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

	public function getMessage(): string
	{
		return $this->message;
	}

	public function getRequest(): int
	{
		return $this->request;
	}

	/**
	 * @throws RequestException
	 */
	protected function setStatus(string $status): void
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
				throw new RequestException(sprintf("Request: Uknown status '%s'.", $status));
		}
	}

	public function getStatus(): string
	{
		return $this->status;
	}

	public function getType(): int
	{
		return self::TYPE_CONFIRM;
	}

}
