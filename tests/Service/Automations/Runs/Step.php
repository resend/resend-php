<?php

use Resend\Automations\Runs\Step;
use Resend\Collection;

it('can get a automation run step by id', function () {
    $client = mockClient('GET', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd/runs/a1b2c3d4-e5f6-7890-abcd-ef1234567890/steps/s1a2b3c4-d5e6-7890-abcd-ef1234567890', [], [], automationRunStep());

    $result = $client->automations->runs->steps->get(
        automationId: 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
        runId: 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
        stepId: 's1a2b3c4-d5e6-7890-abcd-ef1234567890'
    );

    expect($result)->toBeInstanceOf(Step::class)
        ->id->toBe('s1a2b3c4-d5e6-7890-abcd-ef1234567890');
});

it('can get a list automation run steps', function () {
    $client = mockClient('GET', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd/runs/a1b2c3d4-e5f6-7890-abcd-ef1234567890/steps', [], [], automationRunSteps());

    $result = $client->automations->runs->steps->list(
        automationId: 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
        runId: 'a1b2c3d4-e5f6-7890-abcd-ef1234567890'
    );

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
