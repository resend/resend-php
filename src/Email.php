<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property string $id The unique identifier for the email.
 * @property string $from The sender's email address.
 * @property array $to The email addresses of all recipients.
 * @property string $created_at Time at which the email was created.
 * @property string $subject The email subject.
 * @property null|string $html The HTML representation of the email.
 * @property null|string $text The text representation of the email.
 * @property null|array $bcc The email addresses of all blind carbon copy recipients.
 * @property null|array $cc The email addresses of all carbon copy recipients.
 * @property null|array $reply_to The reply to email address.
 * @property string $last_event The last event for the email.
 */
class Email extends Resource
{

    /**
     * Add a recipient to the email.
     * @param string $email The recipient's email address.
     * @return $this 
     */
    public function to(string $email): static
    {
        $this->attributes['to'][] = $email;

        return $this;
    }

    /**
     * Set the sender's email address.
     * @param string $email The sender's email address.
     * @return $this 
     */
    public function sendFrom(string $email): static
    {
        $this->attributes['from'] = $email;

        return $this;
    }

    /**
     * Set the email subject.
     * @param string $subject The email subject.
     * @return $this 
     */
    public function subject(string $subject): static
    {
        $this->attributes['subject'] = $subject;

        return $this;
    }

    /**
     * Set the HTML representation of the email.
     * @param string $html The HTML representation of the email.
     * @return $this 
     */
    public function html(string $html): static
    {
        $this->attributes['html'] = $html;

        return $this;
    }

    /**
     * Set the text representation of the email.
     * @param string $text The text representation of the email.
     * @return $this 
     */
    public function text(string $text): static
    {
        $this->attributes['text'] = $text;

        return $this;
    }

    /**
     * Add a blind carbon copy recipient to the email.
     * @param string $email The email address of the blind carbon copy recipient.
     * @return $this 
     */
    public function bcc(string $email): static
    {
        $this->attributes['bcc'][] = $email;

        return $this;
    }

    /**
     * Add a carbon copy recipient to the email.
     * @param string $email The email address of the carbon copy recipient.
     * @return $this 
     */
    public function cc(string $email): static
    {
        $this->attributes['cc'][] = $email;

        return $this;
    }

    /**
     * Set the reply to email address.
     * @param string $email The reply to email address.
     * @return $this 
     */
    public function replyTo(string $email): static
    {
        $this->attributes['reply_to'] = $email;

        return $this;
    }

}
