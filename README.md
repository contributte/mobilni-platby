# MobilniPlatby

Maly wrapper pro Nette Framework pro komunikaci s portalem http://mobilniplatby.cz/.

## Ukazka pouziti

```php
    use MobilniPlatby\CallbackDispatcher;
    use MobilniPlatby\ConfirmRequest;
    use MobilniPlatby\ConfirmResponse;
    use MobilniPlatby\Request;
    use MobilniPlatby\RequestFactory;
    use MobilniPlatby\Response;
    use MobilniPlatby\Tests\TestDispatcher;
    use Nette\Callback;

    class SmsPresenter extends \Nette\Application\UI\Presenter
    {

        /**
         * First example
         * Your custom dispatcher
         */
        public function actionDefaultFirst()
        {
            // Create request factory
            $requestFactory = new RequestFactory($this->getHttpRequest());

            // Create your dispatcher
            $dispatcher = new TestDispatcher();

            // Send response
            $this->sendResponse($dispatcher->dispatch($requestFactory->create()));
        }

        /**
         * Second example
         * Predefined CallbackDispatcher
         */
        public function actionDefaultSecond()
        {

            // Create request factory
            $requestFactory = new RequestFactory($this->getHttpRequest());

            // Create dispatcher
            $dispatcher = new CallbackDispatcher();

            // Register confirm callback - you custom answer
            // You can register Nette\Callback or Closure..
            $dispatcher->registerCallback(function (Request $request) {
                return new Response("Moje odpoved!");
            });

            // Register confirm callback - for auto answer
            $dispatcher->registerConfirmCallback(new Callback(function (ConfirmRequest $request) {
                return new ConfirmResponse();
            }));

            // Send response
            $this->sendResponse($dispatcher->dispatch($requestFactory->create()));
        }
    }
```

```php
namespace MobilniPlatby\Tests;

use MobilniPlatby\AbstractRequest;
use MobilniPlatby\Dispatcher;
use MobilniPlatby\Response;
use Nette\Object;

class TestDispatcher extends Object implements Dispatcher
{

	/**
	 * @param AbstractRequest $request
	 * @return Response
	 */
	public function dispatch(AbstractRequest $request)
	{
		return new Response("Tohle je super!", "FREE12039123");
	}

}
```