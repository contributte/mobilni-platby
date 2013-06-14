<?php

namespace MobilniPlatby;

use Nette\Application\IResponse;
use Nette\Object;

class ConfirmResponse extends Object implements IResponse
{

	/**
	 * @param \Nette\Http\IRequest $httpRequest
	 * @param \Nette\Http\IResponse $httpResponse
	 */
	function send(\Nette\Http\IRequest $httpRequest, \Nette\Http\IResponse $httpResponse)
	{
		$httpResponse->setCode(204);
	}


}