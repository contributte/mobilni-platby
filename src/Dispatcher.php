<?php

namespace MobilniPlatby;

use MobilniPlatby\Request\AbstractRequest;
use MobilniPlatby\Response\AbstractResponse;

/**
 * Dispatcher interface
 *
 * @version 1.0.1
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
interface Dispatcher
{

    /**
     * @param AbstractRequest $request
     * @return AbstractResponse
     */
    public function dispatch(AbstractRequest $request);
}
