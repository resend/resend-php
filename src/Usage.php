<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property array $emails Daily and monthly email usage, each with `used`, `limit` (nullable), `sent`, `received`, and `resets_at`.
 * @property array $contacts Contact usage, with `used` and `limit`.
 * @property array $segments Segment usage, with `used` and `limit` (nullable).
 * @property array $broadcasts Broadcast usage, with `used` and `limit` (always null).
 * @property array $ai_credits AI credits usage, with `used`, `limit` (nullable), and `next_increase_at` (nullable).
 * @property array $automation_runs Automation run usage, with `used`, `limit`, and `resets_at`.
 * @property array $domains Domain usage, with `used` and `limit` (nullable).
 * @property array $rate_limit The account's rate limit, with `limit` and `duration`.
 */
class Usage extends Resource
{
    //
}
