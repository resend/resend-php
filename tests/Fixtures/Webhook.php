<?php

function webhook(?int $timestamp = null)
{
    $payload = '{"test": 2432232315}';
    $secret = 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $id = 'msg_p5jXN8AQM9LWM0D4loKWxJek';

    $toSign = "{$id}.{$timestamp}.{$payload}";
    $signature = base64_encode(pack('H*', hash_hmac('sha256', $toSign, base64_decode($secret))));

    $headers = [
        'svix-id' => $id,
        'svix-signature' => "v1,{$signature}",
        'svix-timestamp' => $timestamp,
    ];

    return [
        'payload' => $payload,
        'headers' => $headers,
    ];
}
