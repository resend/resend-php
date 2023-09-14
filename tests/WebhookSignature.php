<?php

use Resend\Exceptions\WebhookSignatureVerificationException;
use Resend\WebhookSignature;

beforeEach(function () {
    $this->secret = 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $this->wrongSecret = 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaS';
});

it('returns a true value', function () {
    $webhook = webhook(time());

    $verified = WebhookSignature::verify($webhook['payload'], $webhook['headers'], $this->secret, 300);

    expect($verified)->toBeTrue();
});

it('throws an exception when a required header is missing', function () {
    $webhook = webhook(time());
    $headers = array_slice($webhook['headers'], 2, 1);

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class);

it('throws an exception for an incorrect signature version', function () {
    $webhook = webhook(time());
    $headers = array_merge($webhook['headers'], [
        'svix-signature' => 'signature',
    ]);

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class, 'No signatures found matching the expected signature');

it('can remove the whsec_ prefix from the secret before verification', function () {
    $webhook = webhook(time());

    $verified = WebhookSignature::verify($webhook['payload'], $webhook['headers'], 'whsec_' . $this->secret, 300);

    expect($verified)->toBeTrue();
});

it('throws an exception for an incorrect timestamp', function () {
    $webhook = webhook(null);
    $headers = array_merge($webhook['headers'], [
        'svix-timestamp' => 'September',
    ]);

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class, 'Invalid timestamp');

it('throws an exception for an older timestamp', function () {
    $webhook = webhook(time());

    $headers = array_merge($webhook['headers'], [
        'svix-timestamp' => time() - 400,
    ]);

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class, 'Message timestamp too old');

it('throws an exception for a newer timestamp', function () {
    $webhook = webhook(time());

    $headers = array_merge($webhook['headers'], [
        'svix-timestamp' => time() + 400,
    ]);

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class, 'Message timestamp too new');
