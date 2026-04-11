<?php

use Resend\Automations\Run;
use Resend\Collection;

it('can get a automation run by id', function () {
    $client = mockClient('GET', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd/runs/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [], [], automationRun());

    $result = $client->automations->runs->get('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd', 'a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(Run::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can get a list automation runs', function () {
    $client = mockClient('GET', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd/runs', [], [], automationRuns());

    $result = $client->automations->runs->list('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
