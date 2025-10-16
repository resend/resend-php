<?php

use Resend\Attachment;
use Resend\Collection;

it('can get an attachment resource', function () {
    $client = mockClient('GET', 'emails/receiving/4ef9a417-02e9-4d39-ad75-9611e0fcc33c/attachments/2a0c9ce0-3112-4728-976e-47ddcd16a318', [], [], inboundAttachment());

    $result = $client->attachments->receiving->get(
        emailId: '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
        id: '2a0c9ce0-3112-4728-976e-47ddcd16a318'
    );

    expect($result)->toBeInstanceOf(Attachment::class)
        ->id->toBe('2a0c9ce0-3112-4728-976e-47ddcd16a318');
});

it('can get a list of attachment resources', function () {
    $client = mockClient('GET', 'emails/receiving/4ef9a417-02e9-4d39-ad75-9611e0fcc33c/attachments', [], [], inboundAttachments());

    $result = $client->attachments->receiving->list(
        emailId: '4ef9a417-02e9-4d39-ad75-9611e0fcc33c'
    );

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
