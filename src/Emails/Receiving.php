<?php

namespace Resend\Emails;

use Resend\Resource;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the email.
 * @property string $from The sender's email address.
 * @property array $to The email addresses of all recipients.
 * @property string $created_at Time at which the email was created.
 * @property string $subject The email subject.
 * @property null|string $html The HTML representation of the email.
 * @property null|string $text The text representation of the email.
 * @property null|array $bcc The email addresses of all blind carbon copy recipients.
 * @property null|array $cc The email addresses of all carbon copy recipients.
 * @property null|array $reply_to The reply to email address.
 * @property string $message_id The unique identifier for the message.
 * @property null|array $headers The headers for the received email.
 * @property array $attachments The attachments for the email.
 */
class Receiving extends Resource
{
    //
}
