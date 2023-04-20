<?php

use Resend\Email;

test('send email', function () {
    $client = mockClient('POST', 'email', [
        'to' => 'test@resend.com',
    ], email());

    $result = $client->sendEmail([
        'to' => 'test@resend.com',
    ]);

    expect($result)
        ->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->from->toBe('onboarding@resend.dev')
        ->to->toBe('user@gmail.com');
});
