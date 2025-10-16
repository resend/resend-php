<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;
use Resend\Service\Attachments\Receiving;

class Attachment extends Service
{
    public Receiving $receiving;

    /**
     * Create a new attachment service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->receiving = new Receiving($transporter);

        parent::__construct($transporter);
    }
}
