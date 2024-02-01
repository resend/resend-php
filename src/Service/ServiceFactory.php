<?php

namespace Resend\Service;

use Resend\Contracts\Transporter;

class ServiceFactory
{
    /**
     * A list of service classes.
     *
     * @var array<string, string>
     */
    private static array $classMap = [
        'apiKeys' => ApiKey::class,
        'audiences' => Audience::class,
        'batch' => Batch::class,
        'contacts' => Contact::class,
        'domains' => Domain::class,
        'emails' => Email::class,
    ];

    /**
     * A list of available services.
     *
     * @var array<string, string>
     */
    private array $services = [];

    /**
     * Create a new Service Factory instance.
     */
    public function __construct(
        private readonly Transporter $transporter
    ) {
        //
    }

    /**
     * Get the given service by name.
     */
    public function getService(string $name)
    {
        $serviceClass = array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;

        if (! $serviceClass) {
            return null;
        }

        if (! array_key_exists($name, $this->services)) {
            $this->services[$name] = new $serviceClass($this->transporter);
        }

        return $this->services[$name];
    }
}
