<?php

namespace Loevgaard\Dandomain\Pay;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Handler handles the request from Dandomain, typically a POST request with the order specific parameters
 * and turns that request into a PaymentRequest object
 */
class Handler
{
    public function __construct(Request $request)
    {
        // constructor body
    }
}
