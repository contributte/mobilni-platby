<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Request;

use Contributte\MobilniPlatby\RequestException;

class SmsRequest extends AbstractRequest
{

	public const OPERATOR_TMOBILE = 'TMOBILE';
	public const OPERATOR_O2 = 'O2';
	public const OPERATOR_VODAFONE = 'VODAFONE';
	public const OPERATOR_ORANGE = 'ORANGE';

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

	public function __construct(int $id, string $phone, string $shortcode, string $text, int $timestamp, string $operator, string $country, int $att)
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

	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @throws RequestException
	 */
	protected function setOperator(string $operator): void
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
				throw new RequestException(sprintf("Request: Uknown operator '%s'.", $operator));
		}
	}

	public function getOperator(): string
	{
		return $this->operator;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getShortcode(): string
	{
		return $this->shortcode;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function getType(): int
	{
		return self::TYPE_SMS;
	}

}
