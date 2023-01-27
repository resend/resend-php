<?php

namespace Resend\Transporters;

use Psr\Http\Client\ClientInterface;
use Resend\Contracts\Transporter;

class HttpTransporter implements Transporter
{
    /**
     * Create a new HTTP Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client
    ) {
        //
    }

    public function request()
    {
    }
}
