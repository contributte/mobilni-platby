<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Request;

use Contributte\MobilniPlatby\RequestException;
use Nette\Http\Request;
use Nette\Utils\DateTime;

class RequestFactory
{

	/** @var Request */
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * @return SmsRequest|ConfirmRequest
	 * @throws RequestException
	 */
	public function create()
	{
		if ($this->request->getQuery('request')) {
			return $this->createConfirmRequest();
		} else {
			return $this->createSmsRequest();
		}
	}

	/**
	 * @throws RequestException
	 */
	protected function createSmsRequest(): SmsRequest
	{
		$args = $this->request->getQuery();
		$keys = ['id', 'phone', 'shortcode', 'sms', 'timestamp', 'operator', 'country', 'att'];
		foreach ($keys as $key) {
			if (!array_key_exists($key, $args)) {
				throw new RequestException(sprintf("Key '%s' missing in request parameters.", $key));
			}
		}

		$id = (int) $this->request->getQuery('id');
		$phone = $this->request->getQuery('phone');
		$shortcode = $this->request->getQuery('shortcode');
		$text = $this->request->getQuery('sms');
		$timestamp = DateTime::from($this->request->getQuery('timestamp'));
		$operator = $this->request->getQuery('operator');
		$country = $this->request->getQuery('country');
		$att = (int) $this->request->getQuery('att');

		$request = new SmsRequest($id, $phone, $shortcode, $text, $timestamp->getTimestamp(), $operator, $country, $att);
		return $request;
	}

	/**
	 * @throws RequestException
	 */
	protected function createConfirmRequest(): ConfirmRequest
	{
		$args = $this->request->getQuery();
		$keys = ['id', 'request', 'message', 'status', 'timestamp', 'att'];
		foreach ($keys as $key) {
			if (!array_key_exists($key, $args)) {
				throw new RequestException(sprintf("Key '%s' missing in request parameters.", $key));
			}
		}

		$id = (int) $this->request->getQuery('id');
		$request = (int) $this->request->getQuery('request');
		$message = $this->request->getQuery('message');
		$status = $this->request->getQuery('status');
		$timestamp = DateTime::from($this->request->getQuery('timestamp'));
		$att = (int) $this->request->getQuery('att');

		$request = new ConfirmRequest($id, $request, $message, $status, $timestamp->getTimestamp(), $att);
		return $request;
	}

}
