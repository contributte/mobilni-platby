<?php declare(strict_types = 1);

namespace Tests\Cases\Dispatcher;

use Contributte\MobilniPlatby\Request\ConfirmRequest;
use Contributte\MobilniPlatby\Request\SmsRequest;
use Contributte\MobilniPlatby\Response\ConfirmResponse;
use Contributte\MobilniPlatby\Response\Response;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;
use Tests\Fixtures\ConfirmDispatcher;
use Tests\Fixtures\SmsDispatcher;

require_once __DIR__ . '/../../bootstrap.php';

class DummyDispatcherTest extends BaseTestCase
{

	private function createSmsRequest(): SmsRequest
	{
		return new SmsRequest(1, '123456789', '420', 'text', time(), SmsRequest::OPERATOR_O2, 'cz', 8);
	}

	private function createConfirmRequest(): ConfirmRequest
	{
		return new ConfirmRequest(1, 2, ConfirmRequest::MESSAGE_DAILY_LIMIT_EXCEEDE, ConfirmRequest::STATUS_DELIVERED, time(), 5);
	}

	/**
	 * @test
	 */
	public function testDispatcher1(): void
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
	public function testDispatcher2(): void
	{
		$inst = new ConfirmDispatcher();

		/** @var ConfirmResponse $response */
		$response = $inst->dispatch($this->createConfirmRequest());

		Assert::true($response instanceof ConfirmResponse);
	}

}

(new DummyDispatcherTest())->run();
