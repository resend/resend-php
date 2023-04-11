<?php

namespace Resend\Concerns;

use Resend\Contracts\Transporter;

trait Transportable
{
    /**
     * Create a transportable instance with the given transporter.
     */
    public function __construct(
        private readonly Transporter $transporter
    ) {
        //
    }
}
