<?php

namespace Hex\SecondaryPort;

use Hex\Entity\Employee;

interface MessageCompositionPort
{
    public function compose(Employee $recipient);
}
