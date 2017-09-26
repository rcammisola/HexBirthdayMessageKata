<?php

namespace Hex\UseCase;

use Hex\SecondaryPort\EmployeeRepositoryPort;
use Hex\SecondaryPort\MessageCompositionPort;
use Hex\SecondaryPort\MessageTransmissionPort;

class BirthdayMessageUseCase
{
    private $employeeRepository;

    private $message;

    private $transmitter;

    public function __construct(
        EmployeeRepositoryPort $employeeRepository,
        MessageCompositionPort $messageComposer,
        MessageTransmissionPort $messageTransmission
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->message = $messageComposer;
        $this->transmitter = $messageTransmission;
    }

    public function sendGreetings($date)
    {
        $employees = $this->employeeRepository->findBornOn($date);

        foreach ($employees as $employee) {
            $message = $this->message->compose($employee);

            $this->transmitter->send($message);
        }

        return true;
    }
}
