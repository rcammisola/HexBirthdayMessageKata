<?php

namespace Hex\SecondaryPort;

use Hex\Entity\Employee;
use Hex\Entity\Message;

interface MessageTransmissionPort
{
    public function send(Message $message);
}
