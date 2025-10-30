<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the webhook.
 * @property string $created_at Time at which the webhook was created.
 * @property string $status The current status of the webhook.
 * @property string $endpoint The URL where webhook events will be sent.
 * @property array<int, string> $events The array of event types the webhook is subscribed to.
 * @property string $signing_secret The signing secret used to verify this webhook.
 */
class Webhook extends Resource
{
    //
}
