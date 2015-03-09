<?php

use MobilniPlatby\CallbackDispatcher;
use MobilniPlatby\Request\ConfirmRequest;
use MobilniPlatby\Request\RequestFactory;
use MobilniPlatby\Request\SmsRequest;
use MobilniPlatby\Response\ConfirmResponse;
use MobilniPlatby\Response\Response;
use MobilniPlatby\Tests\TestDispatcher;

class SmsPresenter extends \Nette\Application\UI\Presenter
{

    /**
     * Your own dispatcher
     */
    public function actionSms1()
    {
        // Create request factory
        $requestFactory = new RequestFactory($this->getHttpRequest());

        // Create your dispatcher
        $dispatcher = new TestDispatcher();

        // Send response
        $this->sendResponse($dispatcher->dispatch($requestFactory->create()));
    }

    /**
     * Predefined CallbackDispatcher
     */
    public function actionSms2()
    {
        // Create request factory
        $requestFactory = new RequestFactory($this->getHttpRequest());

        // Create dispatcher
        $dispatcher = new CallbackDispatcher();

        // Register sms callback - you custom answer
        $dispatcher->registerSmsCallback(function (SmsRequest $request, Response $response) {
            // Use given $response
            // Or create new one
            return new Response("Moje odpoved!");
        });

        // Register confirm callback - for auto answer
        $dispatcher->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response) {
            // Use given $response
            // Or create new one
            return new ConfirmResponse();
        });

        // Send response
        $this->sendResponse($dispatcher->dispatch($requestFactory->create()));
    }
}
