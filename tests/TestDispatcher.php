<?php

namespace MobilniPlatby\Tests;

use MobilniPlatby\AbstractRequest;
use MobilniPlatby\Dispatcher;
use MobilniPlatby\Request;
use MobilniPlatby\Response;
use Nette\Diagnostics\Debugger;
use Nette\Object;

class TestDispatcher extends Object implements Dispatcher
{

	/**
	 * @param AbstractRequest $request
	 * @return Response
	 */
	public function dispatch(AbstractRequest $request)
	{
		return new Response("Tohle je super!", "FREE12039123");
	}

}