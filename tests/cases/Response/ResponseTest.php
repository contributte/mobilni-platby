<?php declare(strict_types = 1);

namespace Tests\Cases\Response;

use Contributte\MobilniPlatby\Response\Response;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class ResponseTest extends BaseTestCase
{

	/**
	 * @test
	 */
	public function testConstructor1(): void
	{
		$text = 'test';
		$level = 200;
		$response = new Response($text, $level);
		Assert::same($text, $response->getText());
		Assert::same($level, $response->getLevel());
	}

	/**
	 * @test
	 */
	public function testConstructor2(): void
	{
		$text = 'test';
		$response = new Response($text);
		Assert::same($text, $response->getText());
		Assert::null($response->getLevel());
	}

}

(new ResponseTest())->run();
