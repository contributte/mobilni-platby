<?php declare(strict_types = 1);

namespace Tests\Cases\Response;

use Contributte\MobilniPlatby\Response\ConfirmResponse;
use Nette\Http\RequestFactory;
use Ninjify\Nunjuck\TestCase\BaseTestCase;
use Tester\Assert;
use Tests\Fixtures\FakeResponse;

require_once __DIR__ . '/../../bootstrap.php';

class ConfirmResponseTest extends BaseTestCase
{

	/**
	 * @test
	 */
	public function testSendCode(): void
	{
		$httpRequest = (new RequestFactory())->createHttpRequest();
		$httpResponse = new FakeResponse();
		$response = new ConfirmResponse();
		$response->send($httpRequest, $httpResponse);

		Assert::equal(204, $httpResponse->getCode());
	}

}

(new ConfirmResponseTest())->run();
