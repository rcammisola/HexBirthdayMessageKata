<?php

namespace Hex\UseCase;

use Hex\SecondaryPort\EmployeeRepositoryPort;
use Hex\SecondaryPort\MessageCompositionPort;

class BirthdayMessageUseCase
{
    private $employeeRepository;

    private $message;

    public function __construct(
        EmployeeRepositoryPort $employeeRepository,
        MessageCompositionPort $messageComposer
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->message = $messageComposer;
    }

    public function sendGreetings($date)
    {
        $employees = $this->employeeRepository->findBornOn($date);

        foreach ($employees as $employee) {
            $message = $this->message->compose($employee);
        }

        return true;
    }
}
