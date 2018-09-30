<?php declare(strict_types = 1);

namespace Tests\Cases\Request;

use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Request\ConfirmRequest;
use Contributte\MobilniPlatby\Request\SmsRequest;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;
use TypeError;

require_once __DIR__ . '/../../bootstrap.php';

class ConfirmRequestTest extends BaseTestCase
{

	/** @var ConfirmRequest */
	private $defaultRequest;

	protected function setUp(): void
	{
		$this->defaultRequest = new ConfirmRequest(1, 2, ConfirmRequest::MESSAGE_DAILY_LIMIT_EXCEEDE, ConfirmRequest::STATUS_DELIVERED, time(), 5);
	}

	protected function tearDown(): void
	{
		unset($this->defaultRequest);
	}

	/**
	 * @test
	 */
	public function testConstructor(): void
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
	 * @throws TypeError
	 */
	public function testBadConstructor(): void
	{
		new SmsRequest(null, null, null, null, null, null, null, null);
	}

	/**
	 * @test
	 */
	public function testType(): void
	{
		$request = $this->defaultRequest;
		Assert::same(AbstractRequest::TYPE_CONFIRM, $request->getType());
	}

}

(new ConfirmRequestTest())->run();
