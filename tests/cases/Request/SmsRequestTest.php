<?php declare(strict_types = 1);

namespace Tests\Cases\Request;

use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Request\SmsRequest;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;
use TypeError;

require_once __DIR__ . '/../../bootstrap.php';

class SmsRequestTest extends BaseTestCase
{

	/** @var SmsRequest */
	private $defaultRequest;

	protected function setUp(): void
	{
		$this->defaultRequest = new SmsRequest(1, '123456789', '420', 'text', time(), SmsRequest::OPERATOR_O2, 'cz', 8);
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
		$phone = '12356789';
		$shortcode = '420';
		$text = 'text';
		$timestamp = time();
		$operator = SmsRequest::OPERATOR_O2;
		$country = 'cz';
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
		Assert::same(AbstractRequest::TYPE_SMS, $request->getType());
	}

}

(new SmsRequestTest())->run();
