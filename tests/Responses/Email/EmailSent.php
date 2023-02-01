<?php

use Resend\Responses\Email\EmailSent;

test('from', function () {
    $email = EmailSent::from(email());

    expect($email)
        ->toBeInstanceOf(EmailSent::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

test('as array accessible', function () {
    $email = EmailSent::from(email());

    expect($email['id'])->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

test('to array', function () {
    $email = EmailSent::from(email());

    expect($email->toArray())
        ->toBeArray()
        ->toBe(email());
});
