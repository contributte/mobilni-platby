<?php declare(strict_types = 1);

namespace Tests\Cases\Dispatcher;

use Contributte\MobilniPlatby\CallbackDispatcher;
use Contributte\MobilniPlatby\Request\ConfirmRequest;
use Contributte\MobilniPlatby\Request\SmsRequest;
use Contributte\MobilniPlatby\Response\ConfirmResponse;
use Contributte\MobilniPlatby\Response\Response;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class CallbackDispatcherTest extends BaseTestCase
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
	 * @throws Contributte\MobilniPlatby\DispatcherException
	 */
	public function testFailedDispatcher1(): void
	{
		$inst = new CallbackDispatcher();
		$inst->dispatch($this->createSmsRequest());
	}

	/**
	 * @test
	 * @throws Contributte\MobilniPlatby\DispatcherException
	 */
	public function testFailedDispatcher2(): void
	{
		$inst = new CallbackDispatcher();
		$inst->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response): void {
		});
		$inst->dispatch($this->createSmsRequest());
	}

	/**
	 * @test
	 * @throws Contributte\MobilniPlatby\DispatcherException
	 */
	public function testFailedDispatcher3(): void
	{
		$inst = new CallbackDispatcher();
		$inst->registerSmsCallback(function (SmsRequest $request, Response $response): void {
		});
		$inst->dispatch($this->createConfirmRequest());
	}

	/**
	 * @test
	 */
	public function testSmsCallback(): void
	{
		$tempResponse = null;
		$inst = new CallbackDispatcher();
		$inst->registerSmsCallback(function (SmsRequest $request, Response $response) use (&$tempResponse) {
			$response->setText('TEST');
			$tempResponse = $response;
			return $response;
		});
		$inst->dispatch($this->createSmsRequest());

		Assert::false($tempResponse === null);
		Assert::equal('TEST', $tempResponse->getText());
	}

	/**
	 * @test
	 */
	public function testConfirmCallback(): void
	{
		$tempResponse = null;
		$inst = new CallbackDispatcher();
		$inst->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response) use (&$tempResponse) {
			$tempResponse = $response;
			return $response;
		});
		$inst->dispatch($this->createConfirmRequest());

		Assert::false($tempResponse === null);
		Assert::true($tempResponse instanceof ConfirmResponse);
	}

}

(new CallbackDispatcherTest())->run();
