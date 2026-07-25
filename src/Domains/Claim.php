<?php

namespace Resend\Domains;

use Resend\Resource;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the Domain Claim.
 * @property string $name The name of the domain being claimed.
 * @property string $status The status of the domain claim.
 * @property string $domain_id The unique identifier of the placeholder domain created on your team.
 * @property string $region The region where emails will be sent from.
 * @property array $record The DNS record to add for verification.
 * @property string|null $blocked_reason The reason the domain claim was blocked, if applicable.
 * @property string|null $failure_reason The reason the domain claim failed, if applicable.
 * @property string $created_at The timestamp of when the domain claim was created.
 * @property string $expires_at The timestamp of when the domain claim expires.
 */
class Claim extends Resource
{
    //
}
