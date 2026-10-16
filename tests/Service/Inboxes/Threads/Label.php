<?php

use Resend\Collection;
use Resend\Inboxes\Label;

function inboxThreadLabels(array $data): array
{
    return [
        'object' => 'list',
        'data' => $data,
    ];
}

it('can add labels to a thread', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/labels', [
        'labels' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
    ], [], inboxThreadLabels([
        ['id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34', 'name' => 'Billing', 'color' => '#3B82F6'],
    ]));

    $result = $client->inboxes->threads->labels->add('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'labels' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(Label::class)
        ->name->toBe('Billing');
});

it('can add labels to a thread by the inbox email address', function () {
    $client = mockClient('POST', 'inboxes/support%40acme.com/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/labels', [
        'labels' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
    ], [], inboxThreadLabels([]));

    $result = $client->inboxes->threads->labels->add('support@acme.com', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'labels' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
    ]);

    expect($result)->toBeInstanceOf(Collection::class);
});

it('can set the labels of a thread', function () {
    $client = mockClient('PUT', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/labels', [
        'labels' => [],
    ], [], inboxThreadLabels([]));

    $result = $client->inboxes->threads->labels->set('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'labels' => [],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBe([]);
});

it('can remove a label from a thread', function () {
    $client = mockClient('DELETE', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/labels/7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34', [], [], inboxThreadLabels([]));

    $result = $client->inboxes->threads->labels->remove('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBe([]);
});
