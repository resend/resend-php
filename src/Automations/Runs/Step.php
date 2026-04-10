<?php

namespace Resend\Automations\Runs;

use Resend\Resource;

/**
 * @property string $key The key of the automation step.
 * @property string $type The type of automation step.
 * @property string $status The execution status of this step.
 * @property string|null $started_at Time at which the step started executing.
 * @property string|null $completed_at Time at which the step completed executing.
 * @property mixed $output The output produced by the step.
 * @property mixed $error The error produced by the step.
 * @property string $created_at Time at which the step record was created.
 */
class Step extends Resource
{
    //
}
