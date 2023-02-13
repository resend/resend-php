<?php

use Resend\Responses\Email\Sent;

test('from', function () {
    $email = Sent::from(email());

    expect($email)
        ->toBeInstanceOf(Sent::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

test('as array accessible', function () {
    $email = Sent::from(email());

    expect($email['id'])->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

test('to array', function () {
    $email = Sent::from(email());

    expect($email->toArray())
        ->toBeArray()
        ->toBe(email());
});

test('array offset cannot be set', function () {
    $email = Sent::from(email());

    $email['from'] = 'foo@example.com';
})->throws(BadMethodCallException::class);

test('array offset cannot be unset', function () {
    $email = Sent::from(email());

    unset($email['id']);
})->throws(BadMethodCallException::class);
