<?php

// Include Composer autoload file to load Resend SDK classes...
require __DIR__ . '/../vendor/autoload.php';

// Assign a new Resend Client instance to $resend variable, which is automatically autoloaded...
$resend = Resend::client($_ENV['RESEND_API_KEY']);

// Attempt to send out an email...
try {
    // Send an email using plain text...
    $result = $resend->emails->send([
        'from' => $_ENV['MAIL_FROM_ADDRESS'],
        'to' => 'user@gmail.com',
        'subject' => 'hello world',
        'text' => 'it works!',
    ]);
} catch (\Exception $e) {
    exit('Error: ' . $e->getMessage());
}

// Get the ID of the sent email to be saved in a log...
$result->id;
