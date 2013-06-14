# MobilniPlatby

Maly wrapper pro Nette Framework pro komunikaci s portalem http://mobilniplatby.cz/.

## Ukazka pouziti

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
         * Predefined CallbackDipatcher
         */
        public function actionDefaultSecond()
        {

            // Create request factory
            $requestFactory = new RequestFactory($this->getHttpRequest());

            // Create dispatcher
            $dispatcher = new CallbackDispatcher();

            // Register confirm callback - you custom answer
            $dispatcher->registerCallback(new Callback(function (Request $request) {
                return new Response("Moje odpoved!");
            }));

            // Register confirm callback - for auto answer
            $dispatcher->registerConfirmCallback(new Callback(function (ConfirmRequest $request) {
                return new ConfirmResponse();
            }));

            // Send response
            $this->sendResponse($dispatcher->dispatch($requestFactory->create()));
        }
    }