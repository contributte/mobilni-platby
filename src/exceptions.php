<?php

namespace MobilniPlatby;

/**
 * Exceptions
 *
 * @version 1.0.0
 * @author Milan Felix Sulc <rkfelix@gmail.com>
 */

class SmsException extends \RuntimeException
{
}

class DispatcherException extends SmsException
{
}

class RequestException extends SmsException
{
}

class ResponseException extends SmsException
{
}