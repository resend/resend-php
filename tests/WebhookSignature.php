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
    $headers = [
        'svix-id' => $webhook['headers']['svix-id'],
        'svix-signature' => $webhook['signature'],
        'svix-timestamp' => $webhook['headers']['svix-timestamp'],
    ];

    WebhookSignature::verify($webhook['payload'], $headers, $this->secret, 300);
})->throws(WebhookSignatureVerificationException::class, 'No signatures found matching the expected signature');
