<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the contact.
 * @property string $audience_id The audience ID the contact belongs to.
 * @property array<int, string> $segment_ids The segment IDs the contact belongs to.
 * @property string $created_at Time at which the contact was created.
 * @property string $updated_at Time at which the contact was updated.
 * @property string $email The contact's email address.
 * @property null|string $first_name The contact's first name.
 * @property null|string $last_name The contact's last name.
 * @property bool $unsubscribed Whether the contact is unsubscribed.
 */
class ContactEventData extends Resource
{
    //
}
