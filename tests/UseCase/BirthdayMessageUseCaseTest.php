<?php

namespace test\Hex\UseCase;

use PHPUnit\Framework\TestCase;
use Hex\Entity\Employee;
use Hex\SecondaryPort\EmployeeRepositoryPort;
use Hex\UseCase\BirthdayMessageUseCase;

class BirthdayMessageUseCaseTest extends TestCase
{
    public function testUseCaseCreatedSuccessfully()
    {
        $testDate = "2017-09-17";

        $employeeList = [
            new Employee("Doe", "John", "1982/10/08", "john.doe@foobar.com")
        ];

        $repository = $this->createMock(EmployeeRepositoryPort::class);
        $repository->expects($this->once())
            ->method('findBornOn')
            ->with($this->equalTo($testDate))
            ->will($this->returnValue($employeeList));

        $useCase = new BirthdayMessageUseCase($repository);

        $this->assertTrue($useCase->sendGreetings($testDate));
    }
}
