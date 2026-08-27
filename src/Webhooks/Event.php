<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the webhook event.
 * @property string $type The event type.
 * @property string $created_at Time at which the event was created.
 * @property string $status The delivery status of the event.
 * @property string|null $next_attempt_at Time at which the next delivery attempt is scheduled.
 * @property array $payload The event payload sent to the webhook endpoint.
 */
class Event extends Resource
{
}
