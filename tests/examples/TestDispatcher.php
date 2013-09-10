<?php

namespace MobilniPlatby\Tests;

use MobilniPlatby\Dispatcher;
use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Response\AbstractResponse;
use MobilniPlatby\Response\Response;
use Nette\Object;

class TestDispatcher extends Object implements Dispatcher
{

	/**
	 * @param AbstractRequest $request
	 * @param AbstractResponse $response
	 * @return AbstractResponse
	 */
	public function dispatch(AbstractRequest $request)
	{
		return new Response("Tohle je super!", "FREE12039123");
	}

}