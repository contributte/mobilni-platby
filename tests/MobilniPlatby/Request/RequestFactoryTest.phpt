<?php

/**
 * Test: MobilniPlatby\Request
 *
 * @testCase  MobilniPlatby\Request\RequestFactoryTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use Tester\Assert;
use Tester\TestCase;
use Nette\Http\RequestFactory as NRequestFactory;
use MobilniPlatby\Request\RequestFactory;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class RequestFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function testFailedCreate()
    {
        $inst = new RequestFactory((new NRequestFactory())->createHttpRequest());
        Assert::throws(function() use ($inst) {
            $inst->create();
        }, 'MobilniPlatby\RequestException', "Key 'id' missing in request parameters.");
    }


}

(new RequestFactoryTest())->run();
