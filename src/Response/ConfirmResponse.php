<?php

namespace MobilniPlatby\Response;

use Nette;

/**
 * Confirm response
 *
 * @version 1.0.1
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class ConfirmResponse extends AbstractResponse
{

    /**
     * @param Nette\Http\IRequest $httpRequest
     * @param Nette\Http\IResponse $httpResponse
     */
    function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
    {
        $httpResponse->setCode(204);
    }

}
