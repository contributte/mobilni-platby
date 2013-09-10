<?php

namespace MobilniPlatby;

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Response\AbstractResponse;

interface Dispatcher {

	/**
	 * @param AbstractRequest $request
	 * @return AbstractResponse
	 */
	public function dispatch(AbstractRequest $request);
}