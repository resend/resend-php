<?php

function inboxAgent(): array
{
    return [
        'object' => 'inbox_agent',
        'instructions' => 'Answer billing questions and escalate refunds.',
        'tone' => 'concise_casual',
        'actions' => ['draft_reply', 'archive', 'move_to_trash'],
    ];
}
