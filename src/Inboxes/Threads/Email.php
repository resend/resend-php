<?php

namespace Resend\Inboxes\Threads;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the message.
 * @property 'inbound'|'outbound' $direction Whether the inbox received the message (`inbound`) or sent it (`outbound`).
 * @property string $from The sender email address, with the display name when the sender has one.
 * @property array<int, string> $to The recipients of the message.
 * @property array<int, string> $cc The CC recipients of the message.
 * @property array<int, string> $bcc The BCC recipients of the message. Always empty for a received message.
 * @property array<int, string> $reply_to The Reply-To addresses of the message.
 * @property null|string $subject The subject of the message.
 * @property null|string $message_id The Message-ID header of the message.
 * @property null|string $html The HTML body.
 * @property null|string $text The plain-text body.
 * @property array<int, array{id: string, filename: null|string, size: null|int}> $attachments The attachments of the message.
 * @property bool $read Whether the message has been read.
 * @property string $received_at Time at which the inbox received the message, or when the inbox sent it.
 */
class Email extends Resource
{
    //
}
