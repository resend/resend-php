<?php

namespace Resend\Automations\Runs;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the automation run step.
 * @property string $object The type of object.
 * @property string $step_id The referenced step ID.
 * @property string $type The step type.
 * @property array $config The step config.
 * @property string $status The step status.
 * @property string $started_at Time at which the step started.
 * @property string $completed_at Time at which the step completed.
 * @property string $created_at Time at which the step was created.
 */
class Step extends Resource
{
    //
}
