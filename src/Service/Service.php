<?php

namespace Resend\Service;

use Resend\ApiKey;
use Resend\Audience;
use Resend\Automation;
use Resend\Automations\Run as AutomationRun;
use Resend\Broadcast;
use Resend\Broadcasts\ClickedLink as BroadcastClickedLink;
use Resend\Broadcasts\Recipient as BroadcastRecipient;
use Resend\Collection;
use Resend\Contact;
use Resend\ContactProperty;
use Resend\Contacts\Import as ContactImport;
use Resend\Contacts\Topic as ContactTopic;
use Resend\Contracts\Transporter;
use Resend\Domain;
use Resend\Domains\Claim as DomainClaim;
use Resend\Email;
use Resend\Emails\Attachment;
use Resend\Emails\Receiving;
use Resend\Event;
use Resend\Log;
use Resend\Metrics;
use Resend\Resource;
use Resend\Segment;
use Resend\Suppression;
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
        'broadcast-clicked-links' => BroadcastClickedLink::class,
        'broadcast-recipients' => BroadcastRecipient::class,
        'contact-imports' => ContactImport::class,
        'contact-properties' => ContactProperty::class,
        'contact-topics' => ContactTopic::class,
        'contacts' => Contact::class,
        'domains' => Domain::class,
        'domain-claims' => DomainClaim::class,
        'emails' => Email::class,
        'emails-metrics' => Metrics::class,
        'events' => Event::class,
        'logs' => Log::class,
        'receiving' => Receiving::class,
        'segments' => Segment::class,
        'suppressions' => Suppression::class,
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
     *
     * By default, whether this returns a single resource or a Collection is
     * auto-detected from the presence of a `data` array in $attributes. Pass
     * $asList explicitly when a resource's own attributes happen to include
     * a `data` key that isn't a list of $resourceType items (e.g. metrics'
     * `data` is a breakdown array, not a list of Metrics resources).
     */
    protected function createResource(string $resourceType, array $attributes, ?bool $asList = null)
    {
        $class = isset($this->mapping[$resourceType]) ? $this->mapping[$resourceType] : Resource::class;

        $isList = $asList ?? (isset($attributes['data']) && is_array($attributes['data']));

        if ($isList) {
            foreach ($attributes['data'] as $key => $value) {
                $attributes['data'][$key] = $class::from($value);
            }

            return Collection::from($attributes);
        } else {
            return $class::from($attributes);
        }
    }
}
