<?php

namespace Hex\Entity;

class Message
{
    private $recipient;

    private $subject;

    private $messageBody;

    public function __construct($recipientAddress, $subject, $body)
    {
        $this->recipient = $recipientAddress;
        $this->subject = $subject;
        $this->messageBody = $body;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getSubject()
    {
        return $this->subject;
    }
    
    public function getBody()
    {
        return $this->messageBody;
    }
}
