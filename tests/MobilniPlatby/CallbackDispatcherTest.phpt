<?php

/**
 * Test: MobilniPlatby
 *
 * @testCase  MobilniPlatby\CallbackDispatcherTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use MobilniPlatby\CallbackDispatcher;
use MobilniPlatby\Request\ConfirmRequest;
use MobilniPlatby\Request\SmsRequest;
use MobilniPlatby\Response\ConfirmResponse;
use MobilniPlatby\Response\Response;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class CallbackDispatcherTest extends TestCase
{

    /**
     * @return SmsRequest
     */
    private function createSmsRequest()
    {
        return new SmsRequest(1, 2, 3, 4, time(), SmsRequest::OPERATOR_O2, 7, 8);
    }

    /**
     * @return ConfirmRequest
     */
    private function createConfirmRequest()
    {
        return new ConfirmRequest(1, 2, ConfirmRequest::MESSAGE_DAILY_LIMIT_EXCEEDE, ConfirmRequest::STATUS_DELIVERED, time(), 5);
    }

    /**
     * @test
     * @throws MobilniPlatby\DispatcherException
     */
    public function testFailedDispatcher1()
    {
        $inst = new CallbackDispatcher();
        $inst->dispatch($this->createSmsRequest());
    }

    /**
     * @test
     * @throws MobilniPlatby\DispatcherException
     */
    public function testFailedDispatcher2()
    {
        $inst = new CallbackDispatcher();
        $inst->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response) {
        });
        $inst->dispatch($this->createSmsRequest());
    }

    /**
     * @test
     * @throws MobilniPlatby\DispatcherException
     */
    public function testFailedDispatcher3()
    {
        $inst = new CallbackDispatcher();
        $inst->registerSmsCallback(function (SmsRequest $request, Response $response) {
        });
        $inst->dispatch($this->createConfirmRequest());
    }

    /**
     * @test
     */
    public function testSmsCallback()
    {
        $tempResponse = NULL;
        $inst = new CallbackDispatcher();
        $inst->registerSmsCallback(function (SmsRequest $request, Response $response) use (&$tempResponse) {
            $response->setText('TEST');
            $tempResponse = $response;
            return $response;
        });
        $inst->dispatch($this->createSmsRequest());

        Assert::false(is_null($tempResponse));
        Assert::equal('TEST', $tempResponse->getText());
    }

    /**
     * @test
     */
    public function testConfirmCallback()
    {
        $tempResponse = NULL;
        $inst = new CallbackDispatcher();
        $inst->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response) use (&$tempResponse) {
            $tempResponse = $response;
            return $response;
        });
        $inst->dispatch($this->createConfirmRequest());

        Assert::false(is_null($tempResponse));
        Assert::true($tempResponse instanceof ConfirmResponse);
    }
}

(new CallbackDispatcherTest())->run();
