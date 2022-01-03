![](https://heatbadger.now.sh/github/readme/contributte/mobilni-platby/?deprecated=1)

<p align=center>
    <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
    <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
    <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
    Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

## Disclaimer

| :warning: | This project is no longer being maintained.
|---|---|

| Composer | [`contributte/mobilni-platby`](https://packagist.org/packages/contributte/mobilni-platby) |
|---|-------------------------------------------------------------------------------------------|
| Version | ![](https://badgen.net/packagist/v/contributte/mobilni-platby)                                     |
| PHP | ![](https://badgen.net/packagist/php/contributte/mobilni-platby)                                   |
| License | ![](https://badgen.net/github/license/contributte/mobilni-platby)                                  |

## Usage

```bash
composer require contributte/mobilni-platby
```

## Versions

| State       | Version | Branch   | PHP      |
|-------------|---------|----------|----------|
| dev         | `^0.2`  | `master` | `>= 7.1` |
| stable      | `^0.1`  | `master` | `>= 7.1` |

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

## Development

This package was maintain by these authors.

<a href="https://github.com/f3l1x">
  <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
