<?php

/**
 * Test: MobilniPlatby\Response
 *
 * @testCase  MobilniPlatby\Response\ConfirmResponseTest
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 * @package MobilniPlatby
 */

use MobilniPlatby\Response\ConfirmResponse;
use Nette\Http\RequestFactory;
use Nette\Http\Response;
use Nette\Http\IResponse;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class ConfirmResponseTest extends TestCase
{

    /**
     * @test
     */
    public function testSendCode()
    {

        $httpRequest = (new RequestFactory())->createHttpRequest();
        $httpResponse = new FakeResponse();
        $response = new ConfirmResponse();
        $response->send($httpRequest, $httpResponse);

        Assert::equal(204, $httpResponse->getCode());

    }
}

final class FakeResponse implements IResponse
{

    private $code;

    /**
     * Sets HTTP response code.
     *
     * @param  int
     * @return void
     */
    function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Returns HTTP response code.
     *
     * @return int
     */
    function getCode()
    {
        return $this->code;
    }

    /**
     * Sends a HTTP header and replaces a previous one.
     *
     * @param  string  \Nette\Http\header name
     * @param  string  \Nette\Http\header value
     * @return void
     */
    function setHeader($name, $value)
    {
        // TODO: Implement setHeader() method.
    }

    /**
     * Adds HTTP header.
     *
     * @param  string  \Nette\Http\header name
     * @param  string  \Nette\Http\header value
     * @return void
     */
    function addHeader($name, $value)
    {
        // TODO: Implement addHeader() method.
    }

    /**
     * Sends a Content-type HTTP header.
     *
     * @param  string  \Nette\Http\mime-type
     * @param  string  \Nette\Http\charset
     * @return void
     */
    function setContentType($type, $charset = NULL)
    {
        // TODO: Implement setContentType() method.
    }

    /**
     * Redirects to a new URL.
     *
     * @param  string  \Nette\Http\URL
     * @param  int     \Nette\Http\HTTP code
     * @return void
     */
    function redirect($url, $code = self::S302_FOUND)
    {
        // TODO: Implement redirect() method.
    }

    /**
     * Sets the number of seconds before a page cached on a browser expires.
     *
     * @param  mixed  \Nette\Http\timestamp or number of seconds
     * @return void
     */
    function setExpiration($seconds)
    {
        // TODO: Implement setExpiration() method.
    }

    /**
     * Checks if headers have been sent.
     *
     * @return bool
     */
    function isSent()
    {
        // TODO: Implement isSent() method.
    }

    /**
     * Returns a list of headers to sent.
     *
     * @return array
     */
    function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * Sends a cookie.
     *
     * @param  string \Nette\Http\name of the cookie
     * @param  string \Nette\Http\value
     * @param  mixed \Nette\Http\expiration as unix timestamp or number of seconds; Value 0 means "until the browser is closed"
     * @param  string
     * @param  string
     * @param  bool
     * @param  bool
     * @return void
     */
    function setCookie($name, $value, $expire, $path = NULL, $domain = NULL, $secure = NULL, $httpOnly = NULL)
    {
        // TODO: Implement setCookie() method.
    }

    /**
     * Deletes a cookie.
     *
     * @param  string \Nette\Http\name of the cookie.
     * @param  string
     * @param  string
     * @param  bool
     * @return void
     */
    function deleteCookie($name, $path = NULL, $domain = NULL, $secure = NULL)
    {
        // TODO: Implement deleteCookie() method.
    }

}

(new ConfirmResponseTest())->run();