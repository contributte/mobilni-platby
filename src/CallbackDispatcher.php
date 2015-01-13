<?php

namespace MobilniPlatby;

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Request\ConfirmRequest;
use MobilniPlatby\Response\AbstractResponse;
use MobilniPlatby\Response\ConfirmResponse;
use MobilniPlatby\Response\Response;
use Nette\InvalidArgumentException;
use Nette\Object;
use Nette\Utils\Callback;

/**
 * Callback dispatcher
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
final class CallbackDispatcher extends Object implements Dispatcher
{

    /** @var callable */
    private $smsCallback;

    /** @var callable */
    private $confirmCallback;

    /**
     * @param AbstractRequest $request
     * @return AbstractResponse
     * @throws DispatcherException
     */
    public function dispatch(AbstractRequest $request)
    {
        switch ($request->getType()) {
            case AbstractRequest::TYPE_CONFIRM:
                if (!$this->confirmCallback) {
                    throw new DispatcherException("Dispatcher: Confirm callback is not defined.");
                }
                $res = Callback::invokeArgs($this->confirmCallback, [$request, $this->prepareConfirmResponse()]);
                if (!($res instanceof ConfirmResponse)) {
                    throw new DispatcherException('Return value from callback is not ConfirmResponse type.');
                }
                return $res;
            case AbstractRequest::TYPE_SMS:
                if (!$this->smsCallback) {
                    throw new DispatcherException("Dispatcher: Info callback is not defined.");
                }
                $res = Callback::invokeArgs($this->smsCallback, [$request, $this->prepareResponse()]);
                if (!($res instanceof Response)) {
                    throw new DispatcherException('Return value from callback is not Response type.');
                }
                return $res;
            default:
                throw new DispatcherException("Dispatcher: Uknown request type.");
        }
    }

    /**
     * @param callable $cb
     */
    public function registerSmsCallback($cb)
    {
        if (!is_callable($cb)) throw new InvalidArgumentException('Given callback is not callable.');
        $this->smsCallback = $cb;
    }

    /**
     * @param callable $cb
     */
    public function registerConfirmCallback($cb)
    {
        if (!is_callable($cb)) throw new InvalidArgumentException('Given callback is not callable.');
        $this->confirmCallback = $cb;
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