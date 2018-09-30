<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Response;

use Nette;

class ConfirmResponse extends AbstractResponse
{

	public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
	{
		$httpResponse->setCode(204);
	}

}
