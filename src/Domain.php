<?php

namespace Resend;

/**
 * @property string $object The object type identifier.
 * @property string $id The unique identifier for the domain.
 * @property string $name The domain name.
 * @property string $status The verification status of the domain.
 * @property string $created_at Time at which the domain was created.
 * @property string $region The region the domain is located in.
 * @property bool $open_tracking Whether open tracking is enabled for the domain.
 * @property bool $click_tracking Whether click tracking is enabled for the domain.
 * @property string $tracking_subdomain The subdomain used for tracking links.
 * @property array $capabilities The capabilities of the domain (sending, receiving, etc).
 * @property array $records The list of DNS records to add to your domain.
 */
class Domain extends Resource
{
    //
}
