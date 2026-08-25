<?php

use Resend\Broadcasts\ClickedLink;
use Resend\Collection;

it('can get a list of a broadcast\'s clicked links', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/clicked-links', [], [], broadcastClickedLinks());

    $result = $client->broadcasts->clickedLinks->list('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();

    expect($result->data[0])->toBeInstanceOf(ClickedLink::class)
        ->url->toBe('https://resend.com/pricing');
});

it('can get a list of a broadcast\'s clicked links with pagination options', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/clicked-links?limit=1', [], [], broadcastClickedLinks());

    $result = $client->broadcasts->clickedLinks->list('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', ['limit' => 1]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
