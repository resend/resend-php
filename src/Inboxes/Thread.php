<?php

namespace Resend\Inboxes;

use Resend\Resource;

/**
 * @property null|string $object The type of object. Absent on list and search items.
 * @property string $id The unique identifier for the thread.
 * @property null|string $subject The subject of the thread.
 * @property null|string $from The sender email address. Can include the display name. Absent on a single thread.
 * @property null|array<int, string> $to The recipients of the most recent email. Absent on a single thread.
 * @property null|array<int, string> $cc The CC recipients of the most recent email. Absent on a single thread.
 * @property null|array<int, string> $bcc The BCC recipients of the most recent email. Absent on a single thread.
 * @property array<int, array{id: string, name: string, color: string}> $labels The labels attached to the thread.
 * @property null|int $email_count The number of emails in the thread. Absent on a single thread.
 * @property null|bool $has_attachment Whether the most recent email in the thread has an attachment. Absent on a single thread.
 * @property null|bool $has_draft Whether the thread has an unsent draft. Absent on a single thread.
 * @property bool $read True only when every email in the thread is read.
 * @property null|string $received_at Time at which the thread was last active. Absent on a single thread.
 * @property 'inbox'|'archive'|'spam'|'sent'|'trash' $folder The folder the thread is in.
 * @property null|string $matched_email_id The ID of the email in the thread that matched the search, present on search results. Use it as the email ID with the get, reply and forward thread email methods.
 * @property null|bool $deleted True when the call moved the thread to `trash`, present on the response of the remove endpoint.
 */
class Thread extends Resource
{
    //
}
