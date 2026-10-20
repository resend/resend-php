<?php

namespace Resend\Inboxes;

use Resend\Resource;

/**
 * @property string $object The type of object. Always `inbox_agent`.
 * @property null|string $id The ID of the inbox agent, present on the response of the update endpoint.
 * @property null|string $instructions Instructions the agent follows when it handles the threads of the inbox. Null when no instructions are set.
 * @property null|'concise_professional'|'concise_casual'|'expanded_professional'|'expanded_casual' $tone The tone the agent writes in. Null when no tone is set.
 * @property array<int, 'draft_reply'|'forward_thread'|'add_labels'|'assign_thread'|'mark_as_spam'|'archive'|'move_to_trash'> $actions The actions the agent can take. Empty when no actions are enabled.
 */
class Agent extends Resource
{
    //
}
