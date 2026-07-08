<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $type The webhook event type.
 * @property string $created_at Time at which the webhook event was created.
 * @property DomainEventData $data The domain event data.
 */
class DomainUpdatedEvent extends Resource
{
    //
}
