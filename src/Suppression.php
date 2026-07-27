<?php

namespace Resend;

/**
 * @property string $id The unique identifier for the suppression.
 * @property string $object The type of object.
 * @property string $email The email address.
 * @property string $origin The origin of the suppression.
 * @property null|string $source_id References the email that triggered the suppression. For suppressions with a manual origin, source_id is null.
 * @property string $created_at Time at which the suppression was created.
 */
class Suppression extends Resource
{
    //
}
