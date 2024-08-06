<?php

use Resend\Email;

it('can get an email resource', function () {
    $client = mockClient('GET', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [], email());

    $result = $client->emails->get('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can cancel a scheduled email', function () {
    $client = mockClient('DELETE', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/schedule', [], ['email_id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794']);

    $result = $client->emails->cancelSchedule('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->email_id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});
