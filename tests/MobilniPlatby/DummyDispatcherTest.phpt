<?php

/**
 * Test: MobilniPlatby
 *
 * @testCase  MobilniPlatby\DummyDispatcherTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use MobilniPlatby\CallbackDispatcher;
use MobilniPlatby\Request\SmsRequest;
use MobilniPlatby\Request\ConfirmRequest;
use MobilniPlatby\Response\ConfirmResponse;
use MobilniPlatby\Dispatcher;
use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Response\AbstractResponse;
use MobilniPlatby\Response\Response;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class DummyDispatcherTest extends TestCase
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
     */
    public function testDispatcher1()
    {
        $inst = new SmsDispatcher();

        /** @var Response $response */
        $response = $inst->dispatch($this->createSmsRequest());

        Assert::equal('TEST', $response->getText());
        Assert::equal(100, $response->getLevel());
    }

    /**
     * @test
     */
    public function testDispatcher2()
    {
        $inst = new ConfirmDispatcher();

        /** @var ConfirmResponse $response */
        $response = $inst->dispatch($this->createConfirmRequest());

        Assert::true($response instanceof ConfirmResponse);
    }
}

final class SmsDispatcher implements Dispatcher
{
    /**
     * @param AbstractRequest $request
     * @return AbstractResponse
     */
    public function dispatch(AbstractRequest $request)
    {
        return new Response('TEST', 100);
    }

}

final class ConfirmDispatcher implements Dispatcher
{
    /**
     * @param AbstractRequest $request
     * @return AbstractResponse
     */
    public function dispatch(AbstractRequest $request)
    {
        return new ConfirmResponse();
    }

}

(new DummyDispatcherTest())->run();