<?php

namespace MobilniPlatby\Request;

use Nette\DateTime;
use Nette\Diagnostics\Debugger;
use Nette\Object;

abstract class AbstractRequest extends Object
{

	/** Request types */
	const TYPE_NORMAL = 1;
	const TYPE_CONFIRM = 2;

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
		$time = strtotime($timestamp);
		$this->timestamp = new DateTime($time);
	}

	/**
	 * @return \Nette\DateTime
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}

	/**
	 * @return int
	 */
	abstract function getType();
}