<?php

namespace MobilniPlatby;

use Nette\Http\Request as NRequest;

class RequestFactory
{

	/** @var  NRequest */
	private $request;

	/**
	 * @param NRequest $request
	 */
	function __construct($request)
	{
		$this->request = $request;
	}

	/**
	 * @return Request|ConfirmRequest
	 */
	public function create()
	{
		if ($this->request->getQuery('request')) {
			return $this->createConfirmRequest();
		} else {
			return $this->createRequest();
		}
	}

	/**
	 * @return Request
	 */
	private function createRequest()
	{
		$id = $this->request->getQuery('id');
		$phone = $this->request->getQuery('phone');
		$shortcode = $this->request->getQuery('shortcode');
		$text = $this->request->getQuery('text');
		$timestamp = $this->request->getQuery('timestamp');
		$operator = $this->request->getQuery('operator');
		$country = $this->request->getQuery('country');
		$att = $this->request->getQuery('att');

		$request = new Request($id, $phone, $shortcode, $text, $timestamp, $operator, $country, $att);
		return $request;
	}

	/**
	 * @return ConfirmRequest
	 */
	private function createConfirmRequest()
	{
		$id = $this->request->getQuery('id');
		$request = $this->request->getQuery('request');
		$message = $this->request->getQuery('message');
		$status = $this->request->getQuery('status');
		$timestamp = $this->request->getQuery('timestamp');
		$att = $this->request->getQuery('att');

		$request = new ConfirmRequest($id, $request, $message, $status, $timestamp, $att);
		return $request;
	}

}