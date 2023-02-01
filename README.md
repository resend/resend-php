# Resend PHP

[![Tests](https://img.shields.io/github/actions/workflow/status/jayanratna/resend-php/tests.yml?label=tests&style=for-the-badge&labelColor=000000)](https://github.com/jayanratna/resend-php/actions/workflows/tests.yml)
[![License](https://img.shields.io/github/license/jayanratna/resend-php?color=9cf&style=for-the-badge&labelColor=000000)](https://github.com/jayanratna/resend-php/blob/main/LICENSE)

---

## Getting started

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install Resend via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require resend/client
```

Then, interact with Resend's API:

```php
$resend = Resend::client('re_123456789');

$resend->sendEmail([
    'from' => 'onboarding@resend.dev',
    'to' => 'user@gmail.com',
    'subject' => 'hello world',
    'text' => 'it works!',
]);
```

> **Note**
> This client is heavily inspired by [OpenAI PHP](https://github.com/openai-php).
