<?php

namespace MobilniPlatby;

use RuntimeException;

/**
 * SmsException - parent for all exceptions in this package
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class SmsException extends RuntimeException
{
}

/**
 * DispatcherException
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class DispatcherException extends SmsException
{
}

/**
 * RequestException
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class RequestException extends SmsException
{
}

/**
 * ResponseException
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */
class ResponseException extends SmsException
{
}
