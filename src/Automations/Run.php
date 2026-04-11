<?php

namespace Resend\Automations;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the automation run.
 * @property string $object The type of object.
 * @property string $status The run status.
 * @property string|null $started_at Time at which the run started.
 * @property string|null $completed_at Time at which the run completed.
 * @property string $created_at Time at which the run was created.
 * @property array $steps The steps executed in this run.
 */
class Run extends Resource
{
    //
}
