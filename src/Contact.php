<?php

namespace Resend;

/**
 * @property string $id The unique identifier for the contact.
 * @property string $email The email for the contact.
 * @property null|string $first_name The first name of the contact.
 * @property null|string $last_name The last name of the contact.
 * @property bool $unsubscribed Whether the contact is unsubscribed.
 * @property string $created_at Time at which the contact was created.
 * @property null|array<string, array{value: mixed, type: string}> $properties Custom properties for the contact. Only available for global contacts.
 */
class Contact extends Resource
{
    //
}
