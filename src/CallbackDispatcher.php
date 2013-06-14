<?php

namespace MobilniPlatby;

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
	 * @return Response
	 */
	public function dispatch(AbstractRequest $request)
	{
		if ($request->isConfirm()) {
			if (!$this->dispatchConfirmCallback) {
				throw new DispatcherException("Dispatcher: Confirm callback is not defined.");
			}
			return $this->dispatchConfirmCallback->invokeArgs(array($request));
		} else {
			if (!$this->dispatchCallback) {
				throw new DispatcherException("Dispatcher: Callback is not defined.");
			}
			return $this->dispatchCallback->invokeArgs(array($request));
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

}