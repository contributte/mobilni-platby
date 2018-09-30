<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Request;

use Nette\Utils\DateTime;

abstract class AbstractRequest
{

	public const TYPE_SMS = 1;
	public const TYPE_CONFIRM = 2;

	/** @var int */
	protected $id;

	/** @var int */
	protected $att;

	/** @var DateTime */
	protected $timestamp;

	public function getAtt(): int
	{
		return $this->att;
	}

	public function getId(): int
	{
		return $this->id;
	}

	protected function setTimestamp(int $timestamp): void
	{
		$this->timestamp = DateTime::from($timestamp);
	}

	public function getTimestamp(): DateTime
	{
		return $this->timestamp;
	}

	abstract public function getType(): int;

}
