<?php

namespace MobilniPlatby\Response;

class ConfirmResponse extends AbstractResponse
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