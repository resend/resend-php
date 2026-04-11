<?php

namespace Resend\Service;

use Resend\ApiKey;
use Resend\Audience;
use Resend\Automation;
use Resend\Automations\Run as AutomationRun;
use Resend\Broadcast;
use Resend\Collection;
use Resend\Contact;
use Resend\ContactProperty;
use Resend\Contacts\Topic as ContactTopic;
use Resend\Contracts\Transporter;
use Resend\Domain;
use Resend\Email;
use Resend\Emails\Attachment;
use Resend\Emails\Receiving;
use Resend\Event;
use Resend\Log;
use Resend\Resource;
use Resend\Segment;
use Resend\Template;
use Resend\Topic;
use Resend\Webhook;

abstract class Service
{
    /**
     * @var array<string, \Resend\Resource>
     */
    protected $mapping = [
        'api-keys' => ApiKey::class,
        'attachments' => Attachment::class,
        'audiences' => Audience::class,
        'automation-runs' => AutomationRun::class,
        'automations' => Automation::class,
        'broadcasts' => Broadcast::class,
        'contact-properties' => ContactProperty::class,
        'contact-topics' => ContactTopic::class,
        'contacts' => Contact::class,
        'domains' => Domain::class,
        'emails' => Email::class,
        'events' => Event::class,
        'logs' => Log::class,
        'receiving' => Receiving::class,
        'segments' => Segment::class,
        'templates' => Template::class,
        'topics' => Topic::class,
        'webhooks' => Webhook::class,
    ];

    /**
     * Create a service instance with the given transporter.
     */
    public function __construct(
        protected readonly Transporter $transporter
    ) {
        //
    }

    /**
     * Create a new resource for the given  with the given attributes.
     */
    protected function createResource(string $resourceType, array $attributes)
    {
        $class = isset($this->mapping[$resourceType]) ? $this->mapping[$resourceType] : Resource::class;

        if (isset($attributes['data']) && is_array($attributes['data'])) {
            foreach ($attributes['data'] as $key => $value) {
                $attributes['data'][$key] = $class::from($value);
            }

            return Collection::from($attributes);
        } else {
            return $class::from($attributes);
        }
    }
}
