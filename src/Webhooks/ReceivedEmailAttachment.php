<?php

namespace Resend\Webhooks;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the attachment.
 * @property null|string $filename The file name of the attachment.
 * @property string $content_type The content type of the attachment.
 * @property null|string $content_disposition The content disposition of the attachment.
 * @property null|string $content_id The content ID of the attachment.
 */
class ReceivedEmailAttachment extends Resource
{
    //
}
