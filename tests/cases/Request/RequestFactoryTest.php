<?php declare(strict_types = 1);

namespace Tests\Cases\Request;

use Contributte\MobilniPlatby\Request\RequestFactory;
use Nette\Http\RequestFactory as NRequestFactory;
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

}

(new RequestFactoryTest())->run();
