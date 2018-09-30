# Mobilní platby

## Content

- [Usage - how to use](#usage)
  - [Custom dispatcher](#custom-dispatcher)
  - [Example presenter](#example-presenter)

## Usage

### Custom dispatcher

```php
<?php declare(strict_types = 1);

namespace Your\App;

use Contributte\MobilniPlatby\IDispatcher;
use Contributte\MobilniPlatby\Request\AbstractRequest;
use Contributte\MobilniPlatby\Response\AbstractResponse;
use Contributte\MobilniPlatby\Response\Response;

class TestDispatcher implements IDispatcher
{

	public function dispatch(AbstractRequest $request): AbstractResponse
	{
		return new Response('This is super!');
	}

}
```

### Example presenter

```php
<?php declare(strict_types = 1);

namespace Your\App\Presenters;

use Contributte\MobilniPlatby\Dispatcher\CallbackDispatcher;
use Contributte\MobilniPlatby\Request\ConfirmRequest;
use Contributte\MobilniPlatby\Request\RequestFactory;
use Contributte\MobilniPlatby\Request\SmsRequest;
use Contributte\MobilniPlatby\Response\AbstractResponse;
use Contributte\MobilniPlatby\Response\ConfirmResponse;
use Contributte\MobilniPlatby\Response\Response;
use Nette\Application\UI\Presenter;

class SmsPresenter extends Presenter
{

	public function actionSms1(): void
	{
		$requestFactory = new RequestFactory($this->getHttpRequest());

		$dispatcher = new TestDispatcher();

		$this->sendResponse($dispatcher->dispatch($requestFactory->create()));
	}

	public function actionSms2(): void
	{
		$requestFactory = new RequestFactory($this->getHttpRequest());

		$dispatcher = new CallbackDispatcher();

		$dispatcher->registerSmsCallback(function (SmsRequest $request, Response $response): AbstractResponse {
			return new Response('My response!');
		});

		$dispatcher->registerConfirmCallback(function (ConfirmRequest $request, ConfirmResponse $response) {
			return new ConfirmResponse();
		});
		$this->sendResponse($dispatcher->dispatch($requestFactory->create()));
	}

}

```