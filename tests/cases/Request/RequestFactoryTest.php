<?php declare(strict_types = 1);

namespace Tests\Cases\Request;

use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Request\ConfirmRequest;
use Contributte\MobilniPlatby\Request\RequestFactory;
use Contributte\MobilniPlatby\Request\SmsRequest;
use DateTimeImmutable;
use Nette\Http\Request;
use Nette\Http\RequestFactory as NRequestFactory;
use Nette\Http\UrlScript;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class RequestFactoryTest extends BaseTestCase
{

	/**
	 * @test
	 */
	public function testFailedCreate(): void
	{
		$inst = new RequestFactory((new NRequestFactory())->createHttpRequest());
		Assert::throws(function () use ($inst): void {
			$inst->create();
		}, 'Contributte\MobilniPlatby\RequestException', "Key 'id' missing in request parameters.");
	}

	/**
	 * @param int|string $timestamp
	 */
	private function createRawSmsRequest($timestamp, int $id, string $text, string $phone, string $shortcode, string $country, string $operator, int $att): Request
	{
		$encodedText = urlencode($text);
		return new Request(new UrlScript(sprintf('https://127.0.0.1?timestamp=%s&phone=%s&sms=%s&shortcode=%s&country=%s&operator=%s&att=%s&id=%s', $timestamp, $phone, $encodedText, $shortcode, $country, $operator, $att, $id)));
	}

	/**
	 * @param int|string $timestamp
	 */
	private function createRawConfirmRequest($timestamp, int $id, int $requestId, string $status, string $message): Request
	{
		return new Request(new UrlScript(sprintf('https://127.0.0.1?timestamp=%s&request=%s&status=%s&message=%s&ord=1&cnt=1&att=0&id=%s', $timestamp, $requestId, $status, $message, $id)));
	}

	/**
	 * @test
	 */
	public function testCreateSmsRequest(): void
	{
		$timestamp = 1588855354;
		$id = 512;
		$text = 'TEST 199';
		$phone = '420800000000';
		$shortcode = '90210';
		$country = 'CZ';
		$operator = SmsRequest::OPERATOR_VODAFONE;
		$att = 3;

		$inst = new RequestFactory($this->createRawSmsRequest($timestamp, $id, $text, $phone, $shortcode, $country, $operator, $att));
		$request = $inst->create();
		Assert::true($request instanceof SmsRequest);
		Assert::same(AbstractRequest::TYPE_SMS, $request->getType());
		Assert::same($timestamp, $request->getTimestamp()->getTimestamp());
		Assert::same($id, $request->getId());
		Assert::same($text, $request->getText());
		Assert::same($phone, $request->getPhone());
		Assert::same($shortcode, $request->getShortcode());
		Assert::same($country, $request->getCountry());
		Assert::same($operator, $request->getOperator());
		Assert::same($att, $request->getAtt());
	}

	/**
	 * @test
	 */
	public function testCreateConfirmRequest(): void
	{
		$timestamp = 1588855355;
		$id = 1024;
		$requestId = 512;
		$status = ConfirmRequest::STATUS_DELIVERED;
		$message = ConfirmRequest::MESSAGE_INFO_NOT_AVAILABLEE;

		$inst = new RequestFactory($this->createRawConfirmRequest($timestamp, $id, $requestId, $status, $message));
		$request = $inst->create();
		Assert::true($request instanceof ConfirmRequest);
		Assert::same(AbstractRequest::TYPE_CONFIRM, $request->getType());
		Assert::same($timestamp, $request->getTimestamp()->getTimestamp());
		Assert::same($requestId, $request->getRequest());
		Assert::same($status, $request->getStatus());
		Assert::same($message, $request->getMessage());
		Assert::same($id, $request->getId());
	}

	/**
	 * @test
	 */
	public function testCreateSmsRequestWithFormattedTimestamp(): void
	{
		$timestamp = new DateTimeImmutable();
		$id = 2048;
		$text = 'TEST 199';
		$phone = '420800000000';
		$shortcode = '90210';
		$country = 'CZ';
		$operator = SmsRequest::OPERATOR_VODAFONE;
		$att = 4;

		$inst = new RequestFactory($this->createRawSmsRequest(urlencode($timestamp->format('Y-m-d\TH:i:s')), $id, $text, $phone, $shortcode, $country, $operator, $att));
		$request = $inst->create();
		Assert::true($request instanceof SmsRequest);
		Assert::same(AbstractRequest::TYPE_SMS, $request->getType());
		Assert::same($timestamp->getTimestamp(), $request->getTimestamp()->getTimestamp());
		Assert::same($id, $request->getId());
		Assert::same($text, $request->getText());
		Assert::same($phone, $request->getPhone());
		Assert::same($shortcode, $request->getShortcode());
		Assert::same($country, $request->getCountry());
		Assert::same($operator, $request->getOperator());
		Assert::same($att, $request->getAtt());
	}

	/**
	 * @test
	 */
	public function testCreateConfirmRequestWithFormattedTimestamp(): void
	{
		$timestamp = new DateTimeImmutable();
		$id = 4096;
		$requestId = 2048;
		$status = ConfirmRequest::STATUS_DELIVERED;
		$message = ConfirmRequest::MESSAGE_INFO_NOT_AVAILABLEE;

		$inst = new RequestFactory($this->createRawConfirmRequest(urlencode($timestamp->format('Y-m-d\TH:i:s')), $id, $requestId, $status, $message));
		$request = $inst->create();
		Assert::true($request instanceof ConfirmRequest);
		Assert::same(AbstractRequest::TYPE_CONFIRM, $request->getType());
		Assert::same($timestamp->getTimestamp(), $request->getTimestamp()->getTimestamp());
		Assert::same($requestId, $request->getRequest());
		Assert::same($status, $request->getStatus());
		Assert::same($message, $request->getMessage());
		Assert::same($id, $request->getId());
	}

}

(new RequestFactoryTest())->run();
