<?php

use MobilniPlatby\Response\Response;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/bootstrap.php';

class ResponseTest extends TestCase
{

	/**
	 * @test
	 */
	public function testConstructor1()
	{
		$text = "test";
		$level = 200;
		$response = new Response($text, $level);
		Assert::same($text, $response->getText());
		Assert::same($level, $response->getLevel());
	}

	/**
	 * @test
	 */
	public function testConstructor2()
	{
		$text = "test";
		$response = new Response($text);
		Assert::same($text, $response->getText());
		Assert::null($response->getLevel());
	}
}

$tc = new ResponseTest();
$tc->run();