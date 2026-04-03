<?php

namespace Resend\Automations;

use Resend\Resource;

/**
 * @property string $id The unique identifier for the automation run.
 * @property string $object The type of object.
 * @property string $status The run status.
 * @property array $trigger The trigger details.
 * @property string $started_at Time at which the run started.
 * @property string $completed_at Time at which the run completed.
 * @property string $created_at Time at which the run was created.
 */
class Run extends Resource
{
    //
}
