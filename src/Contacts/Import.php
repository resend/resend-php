<?php

namespace Resend\Contacts;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the contact import.
 * @property string $status The contact import status.
 * @property string $created_at The time at which the contact import was created.
+ * @property null|string $completed_at The time at which the contact import was completed.
 * @property array $counts The imported contact counts.
 */
class Import extends Resource
{
    //
}
