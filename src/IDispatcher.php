<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby;

use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Response\AbstractResponse;

interface IDispatcher
{

	public function dispatch(AbstractRequest $request): AbstractResponse;

}
