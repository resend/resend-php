<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the delivery attempt.
 * @property int $http_status_code The HTTP status code returned by the webhook endpoint.
 * @property string $response The response body returned by the webhook endpoint.
 * @property string $sent_at Time at which the delivery attempt was sent.
 */
class EventAttempt extends Resource
{
}
