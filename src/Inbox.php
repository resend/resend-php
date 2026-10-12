<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the inbox.
 * @property null|string $name Internal name for the inbox. Recipients do not see it.
 * @property string $email_address The address of the inbox.
 * @property null|string $domain_id The ID of the domain that owns the address. Absent on list items.
 * @property null|string $receiving_address The address to forward mail to when forwarding is enabled. `null` otherwise.
 * @property null|string $from_name The name recipients see when mail is sent from this inbox. `null` when not set.
 * @property int $unread The number of unread threads in the Inbox folder.
 * @property null|int $drafts The number of unsent drafts. Absent on list items.
 * @property null|string $last_received Time of the newest received email in the Inbox folder. `null` when the folder has no received email.
 * @property null|string $created_at Time at which the inbox was created. Absent on list items.
 * @property null|bool $deleted Whether the inbox was deleted, present on the response of the remove endpoint.
 */
class Inbox extends Resource
{
    //
}
