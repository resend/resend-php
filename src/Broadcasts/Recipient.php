<?php

namespace Resend\Broadcasts;

use Resend\Resource;

/**
 * @property string $id Opaque cursor identifying this row, used for pagination.
 * @property null|string $contact_id The ID of the contact associated with this recipient, if one exists.
 * @property string $email The recipient's email address.
 * @property int $count The number of times this recipient triggered the event. Only present when the requested type is `opened` or `clicked`.
 * @property string $bounce_type The type of bounce: `permanent`, `transient`, or `undetermined`. Only present when the requested type is `bounced`.
 * @property array $clicked_links The links this recipient clicked. Only present when the requested type is `clicked`.
 */
class Recipient extends Resource
{
    //
}
