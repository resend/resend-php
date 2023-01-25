<?php

use Resend\Client;

final class Resend
{
    public static function client(string $apiKey): Client
    {
        return new Client($apiKey);
    }
}
