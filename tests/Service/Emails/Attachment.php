<?php

use Resend\Collection;
use Resend\Emails\Attachment;

it('can get a sent email attachment resource', function () {
    $client = mockClient('GET', 'emails/4ef9a417-02e9-4d39-ad75-9611e0fcc33c/attachments/2a0c9ce0-3112-4728-976e-47ddcd16a318', [], [], sentAttachment());

    $result = $client->emails->attachments->get(
        emailId: '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
        id: '2a0c9ce0-3112-4728-976e-47ddcd16a318'
    );

    expect($result)->toBeInstanceOf(Attachment::class)
        ->id->toBe('2a0c9ce0-3112-4728-976e-47ddcd16a318');
});

it('can get a list of sent email attachment resources', function () {
    $client = mockClient('GET', 'emails/4ef9a417-02e9-4d39-ad75-9611e0fcc33c/attachments', [], [], sentAttachments());

    $result = $client->emails->attachments->list(
        emailId: '4ef9a417-02e9-4d39-ad75-9611e0fcc33c'
    );

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
