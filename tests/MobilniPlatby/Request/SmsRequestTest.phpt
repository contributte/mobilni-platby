<?php

/**
 * Test: MobilniPlatby\Request
 *
 * @testCase  MobilniPlatby\Request\SmsRequestTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Request\SmsRequest;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class SmsRequestTest extends TestCase
{

    /** @var SmsRequest */
    private $defaultRequest;

    /**
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->defaultRequest = new SmsRequest(1, 2, 3, 4, time(), SmsRequest::OPERATOR_O2, 7, 8);
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
        $phone = 2;
        $shortcode = 3;
        $text = 4;
        $timestamp = time();
        $operator = SmsRequest::OPERATOR_O2;
        $country = 7;
        $att = 8;
        $request = new SmsRequest($id, $phone, $shortcode, $text, $timestamp, $operator, $country, $att);
        Assert::same($id, $request->getId());
        Assert::same($phone, $request->getPhone());
        Assert::same($shortcode, $request->getShortcode());
        Assert::same($text, $request->getText());
        Assert::same($timestamp, $request->getTimestamp()->getTimestamp());
        Assert::same($operator, $request->getOperator());
        Assert::same($country, $request->getCountry());
        Assert::same($att, $request->getAtt());
    }

    /**
     * @test
     * @throws MobilniPlatby\RequestException
     */
    public function testBadConstructor()
    {
        new SmsRequest(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * @test
     */
    public function testType()
    {
        $request = $this->defaultRequest;
        Assert::same(AbstractRequest::TYPE_SMS, $request->getType());
    }
}

(new SmsRequestTest())->run();
