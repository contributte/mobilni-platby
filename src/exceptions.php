<?php

namespace MobilniPlatby;

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