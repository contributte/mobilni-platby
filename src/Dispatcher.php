<?php

namespace MobilniPlatby;

interface Dispatcher {

	/**
	 * @param AbstractRequest $request
	 * @return Response
	 */
	public function dispatch(AbstractRequest $request);
}