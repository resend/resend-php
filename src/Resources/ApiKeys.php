<?php

namespace Resend\Resources;

use Resend\Concerns\Transportable;
use Resend\Contracts\Resource;

final class ApiKeys implements Resource
{
    use Transportable;

    public function create()
    {
    }
}
