<?php

namespace test\Hex\UseCase;

use PHPUnit\Framework\TestCase;
use Hex\Entity\Employee;
use Hex\SecondaryPort\EmployeeRepositoryPort;
use Hex\SecondaryPort\MessageCompositionPort;
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

        $messageComposer = $this->createMock(MessageCompositionPort::class);
        $messageComposer->expects($this->once())
            ->method('compose')
            ->will($this->returnValue("Happy Birthday, John Doe!"));

        $useCase = new BirthdayMessageUseCase(
            $repository,
            $messageComposer
        );

        $this->assertTrue($useCase->sendGreetings($testDate));
    }
}
