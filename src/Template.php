<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the template.
 * @property string $alias The alias of the template.
 * @property string $name The name of the template.
 * @property string $created_at Time at which the template was created.
 * @property string $updated_at Time at which the template was updated.
 * @property string $status The status of the template. Can be `published` or `draft`.
+ * @property null|string $published_at Time at which the template was published.
 * @property string $from The sender's email address.
 * @property string $subject The email subject.
 * @property null|array $reply_to The reply to email addresses.
 * @property string $html The HTML representation of the template.
 * @property null|string $text The text representation of the template.
 * @property array<int, array{key: string, type: string, fallback_value?: mixed}> $variables The array of variables used in the template.
 */
class Template extends Resource
{
    //
}
