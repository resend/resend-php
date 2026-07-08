<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the domain.
 * @property string $name The domain name.
 * @property string $status The domain status.
 * @property string $created_at Time at which the domain was created.
 * @property string $region The region the domain is located in.
 * @property array<int, DomainRecord> $records The DNS records for the domain.
 */
class DomainEventData extends Resource
{
    //
}
