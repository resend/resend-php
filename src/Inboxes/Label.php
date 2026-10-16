<?php

namespace Resend\Inboxes;

use Resend\Resource;

/**
 * @property null|string $object The type of object, present on the create, update and remove responses.
 * @property string $id The unique identifier for the label.
 * @property string $name The name of the label.
 * @property string $color The color of the label, as a `#RRGGBB` hex color in uppercase.
 * @property null|string $created_at Time at which the label was created. Absent on the labels of a thread.
 * @property null|bool $deleted Whether the label was deleted, present on the response of the remove endpoint.
 */
class Label extends Resource
{
    //
}
