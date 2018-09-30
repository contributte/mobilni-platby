<?php declare(strict_types = 1);

namespace Tests\Fixtures;

use Contributte\MobilniPlatby\IDispatcher;
use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Response\AbstractResponse;
use Contributte\MobilniPlatby\Response\ConfirmResponse;

final class ConfirmDispatcher implements IDispatcher
{

	public function dispatch(AbstractRequest $request): AbstractResponse
	{
		return new ConfirmResponse();
	}

}
