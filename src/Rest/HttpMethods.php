<?php

namespace Apidaze\Rest;

/**
 * An abstraction class to use for HTTP methods
 *
 * @package Apidaze\Rest
 */
abstract class HttpMethods
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const HEAD = 'HEAD';
}
