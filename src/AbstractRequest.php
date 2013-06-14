<?php

namespace MobilniPlatby;

use Nette\DateTime;
use Nette\Object;

abstract class AbstractRequest extends Object
{

	/** @var  int */
	protected $id;

	/** @var  int */
	protected $att;

	/** @var  DateTime */
	protected $timestamp;

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
	 * @param string|\Nette\DateTime $timestamp
	 */
	protected function setTimestamp($timestamp)
	{
		$this->timestamp = DateTime::from($timestamp);
	}

	/**
	 * @return \Nette\DateTime
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}

	/**
	 * @return bool
	 */
	abstract function isConfirm();
}