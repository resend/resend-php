<?php

use Resend\Email;
use Resend\Service\ApiKey;

test('send email', function () {
    $client = mockClient('POST', 'emails', [
        'to' => 'test@resend.com',
    ], email());

    // Use deprecated method until it is removed...
    $result = $client->sendEmail([
        'to' => 'test@resend.com',
    ]);

    expect($result)
        ->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->from->toBe('onboarding@resend.dev')
        ->to->toBe('user@gmail.com');
});

test('service is created when required', function () {
    $resend = Resend::client('foo');

    expect($resend->apiKeys)
        ->toBeInstanceOf(ApiKey::class);
});
