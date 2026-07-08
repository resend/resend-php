<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property null|string $broadcast_id The broadcast ID associated with the email.
 * @property string $created_at Time at which the email event was created.
 * @property string $email_id The unique identifier for the email.
 * @property string $from The sender's email address.
 * @property string $message_id The RFC 5322 Message-ID header value.
 * @property string $subject The email subject.
 * @property array<int, string> $to The email addresses of all recipients.
 * @property null|string $template_id The template ID used to send the email.
 * @property null|array<string, string> $tags The tags associated with the email.
 */
class EmailEventData extends Resource
{
    //
}
