<?php

namespace MobilniPlatby;

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Response\AbstractResponse;
use MobilniPlatby\Response\ConfirmResponse;
use MobilniPlatby\Response\Response;
use Nette\Callback;
use Nette\Diagnostics\Debugger;
use Nette\InvalidArgumentException;
use Nette\Object;

final class CallbackDispatcher extends Object implements Dispatcher
{

	/** @var Callback */
	private $dispatchCallback;

	/** @var Callback */
	private $dispatchConfirmCallback;

	/**
	 * @param AbstractRequest $request
	 * @return AbstractResponse
	 * @throws DispatcherException
	 */
	public function dispatch(AbstractRequest $request)
	{
		switch ($request->getType()) {
			case AbstractRequest::TYPE_CONFIRM:
				if (!$this->dispatchConfirmCallback) {
					throw new DispatcherException("Dispatcher: Confirm callback is not defined.");
				}
				return $this->dispatchConfirmCallback->invokeArgs(array($request, $this->prepareConfirmResponse()));
			case AbstractRequest::TYPE_NORMAL:
				if (!$this->dispatchCallback) {
					throw new DispatcherException("Dispatcher: Callback is not defined.");
				}
				return $this->dispatchCallback->invokeArgs(array($request, $this->prepareResponse()));
			default:
				throw new DispatcherException("Dispatcher: Uknown request type.");
		}
	}

	/**
	 * @param Callback|\Closure $cb
	 */
	public function registerCallback($cb)
	{
		$this->dispatchCallback = $this->normalizeCallback($cb);
	}

	/**
	 * @param Callback|\Closure $cb
	 */
	public function registerConfirmCallback($cb)
	{
		$this->dispatchConfirmCallback = $this->normalizeCallback($cb);
	}

	/**
	 * @param Callback|\Closure $cb
	 * @return Callback
	 * @throws \Nette\InvalidArgumentException
	 */
	private function normalizeCallback($cb)
	{
		if ($cb instanceof \Closure) {
			return callback($cb);
		} else if (!($cb instanceof Callback)) {
			throw new InvalidArgumentException("Callback must be \Closure or Nette\Callback type.");
		}
		return $cb;
	}

	/**
	 * @return Response
	 */
	private function prepareResponse()
	{
		$response = new Response(NULL, NULL);
		return $response;
	}

	/**
	 * @return ConfirmResponse
	 */
	private function prepareConfirmResponse()
	{
		$response = new ConfirmResponse();
		return $response;
	}

}