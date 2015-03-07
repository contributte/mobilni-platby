<?php

namespace MobilniPlatby\Response;

use MobilniPlatby\ResponseException;
use Nette;

/**
 * Info response
 *
 * @version 1.0.1
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class Response extends AbstractResponse
{

    /** @var string */
    private $text;

    /** @var string */
    private $level;

    /**
     * @param string $text
     * @param string|null $level [optional]
     */
    function __construct($text, $level = NULL)
    {
        $this->text = $text;
        $this->level = $level;
    }

    /**
     * @param string $level
     * @return self - provide fluent interface
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $text
     * @return self - provide fluent interface
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     * @throws ResponseException
     */
    public function getResponse()
    {
        $text = $this->getText();
        $level = $this->getLevel();

        if (!empty($text) && !empty($level)) {
            return $text . ';' . $level;
        } else if (!empty($text)) {
            return $text;
        } else {
            throw new ResponseException("Response: You have to specified text or text and level.");
        }
    }

    /**
     * @param Nette\Http\IRequest $httpRequest
     * @param Nette\Http\IResponse $httpResponse
     */
    function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
    {
        $response = $this->getResponse();
        $httpResponse->setCode(200);
        $httpResponse->setContentType('text/plain');
        $httpResponse->setHeader('Content-Length', strlen($response));

        echo $response;
    }

}
