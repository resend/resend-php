<?php

namespace Resend\Inboxes;

use Resend\Resource;

/**
 * @property null|string $object The type of object. Absent on list items.
 * @property string $id The unique identifier for the draft.
 * @property 'standalone'|'reply' $type `reply` when the draft replies to an email in an existing thread. `standalone` when the draft starts a new thread.
 * @property null|array<int, string> $to The recipients. `null` or empty when no recipients are set.
 * @property array<int, string> $cc The CC recipients.
 * @property array<int, string> $bcc The BCC recipients.
 * @property null|string $subject The subject.
 * @property null|string $html The HTML body. Absent on list items.
 * @property null|string $text The plain text body. Absent on list items.
 * @property null|string $snippet A short preview of the body, present on list items.
 * @property null|string $thread_id The Thread ID when the draft is a reply. `null` otherwise.
 * @property null|string $reply_to_email_id The Email ID the draft replies to. `null` otherwise.
 * @property null|string $email_id The ID of the outbound email queued when the draft was sent. `null` until the draft is sent. Absent on list items.
 * @property array<int, array{id: string, filename: string, content_type: string, size: int}> $attachments The files stored on the draft.
 * @property null|string $created_at Time at which the draft was created. Absent on list items.
 * @property string $updated_at Time at which the draft was last saved.
 * @property null|bool $deleted Whether the draft was deleted, present on the response of the remove endpoint.
 */
class Draft extends Resource
{
    //
}
