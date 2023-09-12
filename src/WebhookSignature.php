<?php

namespace Resend;

use Exception;
use Resend\Exceptions\WebhookSignatureVerificationException;

final class WebhookSignature
{
    public static function verify(string $payload, array $headers, string $secret, ?int $tolerance = null): bool
    {
        $secret = static::getSecret($secret);

        if (isset($headers['svix-id']) && isset($headers['svix-timestamp']) && isset($headers['svix-signature'])) {
            $messageId = $headers['svix-id'];
            $messageTimestamp = $headers['svix-timestamp'];
            $messageSignature = $headers['svix-signature'];
        } else {
            throw new WebhookSignatureVerificationException('Missing required headers');
        }

        $timestamp = static::verifyTimestamp($messageTimestamp, $tolerance);
        $signature = static::sign($secret, $messageId, $timestamp, $payload);

        $expectedSignature = explode(',', $signature, 2)[1];
        $passedSignatures = explode(' ', $messageSignature);

        $signatureFound = false;

        foreach ($passedSignatures as $versionedSignature) {
            $signatureParts = explode(',', $versionedSignature, 2);
            $version = $signatureParts[0];
            $passedSignature = $signatureParts[1];

            if ($version !== 'v1') {
                continue;
            }

            if (hash_equals($expectedSignature, $passedSignature)) {
                $signatureFound = true;

                break;
            }
        }

        if (! $signatureFound) {
            throw new WebhookSignatureVerificationException('No signatures found matching the expected signature');
        }

        return true;
    }

    protected static function sign(string $secret, string $messageId, int $timestamp, string $payload): string
    {
        $toSign = "{$messageId}.{$timestamp}.{$payload}";
        $hash = hash_hmac('sha256', $toSign, $secret);
        $signature = base64_encode(pack('H*', $hash));

        return "v1,{$signature}";
    }

    protected static function getSecret(string $secret): string
    {
        $prefix = 'whsec_';
        if (substr($secret, 0, strlen($prefix)) === $prefix) {
            $secret = substr($secret, strlen($prefix));
        }

        return base64_decode($secret);
    }

    protected static function verifyTimestamp(string $timestamp, int $tolerance = 300)
    {
        $now = time();

        try {
            $timestamp = intval($timestamp, 10);
        } catch (Exception $exception) {
            throw new WebhookSignatureVerificationException('Invalid timestamp');
        }

        if ($timestamp < ($now - $tolerance)) {
            throw new WebhookSignatureVerificationException('Message timestamp too old');
        }

        if ($timestamp > ($now + $tolerance)) {
            throw new WebhookSignatureVerificationException('Message timestamp too new');
        }

        return $timestamp;
    }
}
