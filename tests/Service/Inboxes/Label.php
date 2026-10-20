<?php

use Resend\Collection;
use Resend\Inboxes\Label;

it('can get a list of label resources for an inbox', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/labels', [], [], inboxLabels());

    $result = $client->inboxes->labels->list('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(Label::class)
        ->color->toBe('#3B82F6');
});

it('can create a label resource on an inbox', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/labels', [
        'name' => 'Billing',
        'color' => '#3b82f6',
    ], [], [
        'object' => 'inbox_label',
        'id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34',
    ]);

    $result = $client->inboxes->labels->create('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'name' => 'Billing',
        'color' => '#3b82f6',
    ]);

    expect($result)->toBeInstanceOf(Label::class)
        ->id->toBe('7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34');
});

it('can update a label resource on an inbox', function () {
    $client = mockClient('PATCH', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/labels/7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34', [
        'color' => '#10B981',
    ], [], [
        'object' => 'inbox_label',
        'id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34',
    ]);

    $result = $client->inboxes->labels->update('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34', [
        'color' => '#10B981',
    ]);

    expect($result)->toBeInstanceOf(Label::class)
        ->id->toBe('7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34');
});

it('can remove a label resource from an inbox', function () {
    $client = mockClient('DELETE', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/labels/7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34', [], [], [
        'object' => 'inbox_label',
        'id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34',
        'deleted' => true,
    ]);

    $result = $client->inboxes->labels->remove('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34');

    expect($result)->toBeInstanceOf(Label::class)
        ->deleted->toBeTrue();
});
