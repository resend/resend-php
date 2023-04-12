<?php

namespace Resend\Resources;

use Resend\Contracts\Resource;
use Resend\Contracts\Transporter;

final class ResourceFactory
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = [
        'apiKeys' => ApiKeys::class,
        'domains' => Domains::class,
    ];

    private array $resources = [];

    public function __construct(
        private readonly Transporter $transporter
    ) {
        //
    }

    public function getResource(string $name): ?Resource
    {
        $resourceClass = array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;

        if (! $resourceClass) {
            return null;
        }

        if (! array_key_exists($name, $this->resources)) {
            $this->resources[$name] = new $resourceClass($this->transporter);
        }

        return $this->resources[$name];
    }
}
