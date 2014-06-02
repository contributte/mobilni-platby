<?php

/**
 * Test: MobilniPlatby\Request
 *
 * @testCase  MobilniPlatby\Request\ConfirmRequestTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Request\ConfirmRequest;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class ConfirmRequestTest extends TestCase
{

    /** @var ConfirmRequest */
    private $defaultRequest;

    /**
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->defaultRequest = new ConfirmRequest(1, 2, ConfirmRequest::MESSAGE_DAILY_LIMIT_EXCEEDE, ConfirmRequest::STATUS_DELIVERED, time(), 5);
    }

    /**
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->defaultRequest);
    }

    /**
     * @test
     */
    public function testConstructor()
    {
        $id = 1;
        $request = 2;
        $message = ConfirmRequest::MESSAGE_DAILY_LIMIT_EXCEEDE;
        $status = ConfirmRequest::STATUS_DELIVERED;
        $timestamp = time();
        $att = 5;
        $confirmrequest = new ConfirmRequest($id, $request, $message, $status, $timestamp, $att);
        Assert::same($id, $confirmrequest->getId());
        Assert::same($request, $confirmrequest->getRequest());
        Assert::same($message, $confirmrequest->getMessage());
        Assert::same($status, $confirmrequest->getStatus());
        Assert::same($timestamp, $confirmrequest->getTimestamp()->getTimestamp());
        Assert::same($att, $confirmrequest->getAtt());
    }

    /**
     * @test
     * @throws MobilniPlatby\RequestException
     */
    public function testBadConstructor()
    {
        new ConfirmRequest(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * @test
     */
    public function testType()
    {
        $request = $this->defaultRequest;
        Assert::same(AbstractRequest::TYPE_CONFIRM, $request->getType());
    }
}

(new ConfirmRequestTest())->run();