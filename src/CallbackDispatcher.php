<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby;

use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Response\AbstractResponse;
use Contributte\MobilniPlatby\Response\ConfirmResponse;
use Contributte\MobilniPlatby\Response\Response;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\Callback;

final class CallbackDispatcher implements IDispatcher
{

	use SmartObject;

	/** @var callable */
	private $smsCallback;

	/** @var callable */
	private $confirmCallback;

	/**
	 * @throws DispatcherException
	 */
	public function dispatch(AbstractRequest $request): AbstractResponse
	{
		switch ($request->getType()) {
			case AbstractRequest::TYPE_CONFIRM:
				if (!$this->confirmCallback) {
					throw new DispatcherException('Dispatcher: Confirm callback is not defined.');
				}
				$res = Callback::invokeArgs($this->confirmCallback, [$request, $this->prepareConfirmResponse()]);
				if (!($res instanceof ConfirmResponse)) {
					throw new DispatcherException('Return value from callback is not ConfirmResponse type.');
				}
				return $res;
			case AbstractRequest::TYPE_SMS:
				if (!$this->smsCallback) {
					throw new DispatcherException('Dispatcher: Info callback is not defined.');
				}
				$res = Callback::invokeArgs($this->smsCallback, [$request, $this->prepareResponse()]);
				if (!($res instanceof Response)) {
					throw new DispatcherException('Return value from callback is not Response type.');
				}
				return $res;
			default:
				throw new DispatcherException('Dispatcher: Uknown request type.');
		}
	}

	public function registerSmsCallback(callable $cb): void
	{
		if (!is_callable($cb)) throw new InvalidArgumentException('Given callback is not callable.');
		$this->smsCallback = $cb;
	}

	public function registerConfirmCallback(callable $cb): void
	{
		if (!is_callable($cb)) throw new InvalidArgumentException('Given callback is not callable.');
		$this->confirmCallback = $cb;
	}

	private function prepareResponse(): Response
	{
		$response = new Response();
		return $response;
	}

	private function prepareConfirmResponse(): ConfirmResponse
	{
		$response = new ConfirmResponse();
		return $response;
	}

}
