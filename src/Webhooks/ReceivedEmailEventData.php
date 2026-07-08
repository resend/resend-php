<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $email_id The unique identifier for the email.
 * @property string $created_at Time at which the email was received.
 * @property string $from The sender's email address.
 * @property array<int, string> $to The email addresses of all recipients.
 * @property array<int, string> $bcc The email addresses of all blind carbon copy recipients.
 * @property array<int, string> $cc The email addresses of all carbon copy recipients.
 * @property array<int, string> $received_for The addresses the email was received for.
 * @property string $message_id The RFC 5322 Message-ID header value.
 * @property string $subject The email subject.
 * @property array<int, ReceivedEmailAttachment> $attachments The attachments for the email.
 */
class ReceivedEmailEventData extends Resource
{
    //
}
