<?php

namespace Resend;

/**
 * @property string $id The unique identifier for the domain.
 * @property string $name The domain name.
 * @property string $status The verification status of the domain.
 * @property string $capability The capability of the domain.
 * @property string $created_at Time at which the domain was created.
 * @property string $region The region the domain is located in.
 * @property array $records The list of DNS records to add to your domain.
 */
class Domain extends Resource
{
    //
}
