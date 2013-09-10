<?php

use MobilniPlatby\Response\ConfirmResponse;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/bootstrap.php';

class ConfirmResponseTest extends TestCase
{

	/**
	 * @test
	 */
	public function testConstructor()
	{
		$response = new \MobilniPlatby\Response\ConfirmResponse();
	}
}

$tc = new ConfirmResponseTest();
$tc->run();