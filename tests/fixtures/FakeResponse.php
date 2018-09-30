<?php declare(strict_types = 1);

namespace Tests\Fixtures;

use Nette\Http\IResponse;

final class FakeResponse implements IResponse
{

	/** @var int */
	private $code;

    // @codingStandardsIgnoreStart SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
	public function setCode($code)
	{
		$this->code = $code;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setHeader($name, $value)
	{
	}

	public function addHeader($name, $value)
	{
	}

	public function setContentType($type, $charset = null)
	{
	}

	public function redirect($url, $code = self::S302_FOUND)
	{
	}

	/**
	 * @param  string|int|DateTime $seconds
	 */
	public function setExpiration($seconds)
	{
	}

	public function isSent()
	{
	}

	public function getHeader($header, $default = null)
	{
	}

	public function getHeaders()
	{
	}

	public function setCookie($name, $value, $expire, $path = null, $domain = null, $secure = null, $httpOnly = null)
	{
	}

	public function deleteCookie($name, $path = null, $domain = null, $secure = null)
	{
	}
    // @codingStandardsIgnoreEnd SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint

}
