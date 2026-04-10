<?php

function automation(): array
{
    return [
        'object' => 'automation',
        'id' => 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
        'name' => 'Welcome series',
        'status' => 'enabled',
        'created_at' => '2025-10-01 12:00:00.000000+00',
        'updated_at' => '2025-10-01 12:00:00.000000+00',
        'steps' => [
            [
                'key' => 'trigger',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
            ],
            [
                'key' => 'send_welcome',
                'type' => 'send_email',
                'config' => [
                    'template' => ['id' => 'tpl_xxxxxxxxx', 'variables' => ['name' => '{{first_name}}']],
                    'subject' => 'Welcome!',
                    'from' => 'Acme <hello@example.com>',
                    'reply_to' => 'support@example.com',
                ],
            ],
            [
                'key' => 'wait_2_days',
                'type' => 'delay',
                'config' => ['duration' => '2 days'],
            ],
            [
                'key' => 'wait_for_onboarding',
                'type' => 'wait_for_event',
                'config' => [
                    'event_name' => 'onboarding.completed',
                    'timeout' => '3 days',
                    'filter_rule' => ['type' => 'rule', 'field' => 'plan', 'operator' => 'equals', 'value' => 'pro'],
                ],
            ],
            [
                'key' => 'check_plan',
                'type' => 'condition',
                'config' => [
                    'type' => 'rule',
                    'field' => 'plan',
                    'operator' => 'equals',
                    'value' => 'pro',
                ],
            ],
            [
                'key' => 'update_contact',
                'type' => 'contact_update',
                'config' => [
                    'first_name' => '{{first_name}}',
                    'unsubscribed' => false,
                    'properties' => ['onboarded' => true],
                ],
            ],
            [
                'key' => 'add_to_active',
                'type' => 'add_to_segment',
                'config' => ['segment_id' => 'seg_xxxxxxxxx'],
            ],
            [
                'key' => 'remove_contact',
                'type' => 'contact_delete',
                'config' => (object) [],
            ],
            [
                'key' => 'send_getting_started',
                'type' => 'send_email',
                'config' => [
                    'template' => ['id' => 'f6e86e54-0ab4-404d-8edc-d52ea8cf602e'],
                    'subject' => 'Getting started',
                    'from' => 'Acme <hello@example.com>',
                ],
            ],
        ],
        'connections' => [
            [
                'from' => 'trigger',
                'to' => 'send_welcome',
                'type' => 'default',
            ],
            [
                'from' => 'send_welcome',
                'to' => 'wait_2_days',
                'type' => 'default',
            ],
            [
                'from' => 'wait_2_days',
                'to' => 'wait_for_onboarding',
                'type' => 'default',
            ],
            [
                'from' => 'wait_for_onboarding',
                'to' => 'check_plan',
                'type' => 'event_received',
            ],
            [
                'from' => 'wait_for_onboarding',
                'to' => 'send_getting_started',
                'type' => 'timeout',
            ],
            [
                'from' => 'check_plan',
                'to' => 'update_contact',
                'type' => 'condition_met',
            ],
            [
                'from' => 'check_plan',
                'to' => 'remove_contact',
                'type' => 'condition_not_met',
            ],
            [
                'from' => 'update_contact',
                'to' => 'add_to_active',
                'type' => 'default',
            ],
        ],
    ];
}

function automations(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'object' => 'automation',
                'id' => 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
                'name' => 'Welcome series',
                'status' => 'enabled',
                'created_at' => '2025-10-01 12:00:00.000000+00',
                'updated_at' => '2025-10-01 12:00:00.000000+00',
            ],
        ],
    ];
}
