<?php

function inboxAgent(): array
{
    return [
        'object' => 'inbox_agent',
        'instructions' => 'Answer billing questions and escalate refunds.',
        'tone' => 'friendly and concise',
        'enabled_actions' => ['draft_reply', 'add_labels'],
    ];
}
