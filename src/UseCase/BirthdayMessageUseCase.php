<?php

namespace Hex\UseCase;

use Hex\SecondaryPort\EmployeeRepositoryPort;

class BirthdayMessageUseCase
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryPort $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function sendGreetings($date)
    {
        $employees = $this->employeeRepository->findBornOn($date);
        
        return true;
    }
}
