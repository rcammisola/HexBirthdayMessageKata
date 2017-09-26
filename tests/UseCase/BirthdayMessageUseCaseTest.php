<?php

namespace test\Hex\UseCase;

use PHPUnit\Framework\TestCase;
use Hex\Entity\Employee;
use Hex\Entity\Message;
use Hex\SecondaryPort\EmployeeRepositoryPort;
use Hex\SecondaryPort\MessageCompositionPort;
use Hex\SecondaryPort\MessageTransmissionPort;
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

        // TODO: Should return a Message object with subject, body and recipient
        // Pass the Message to the transmission service
        $composedMessage = new Message(
            "john.doe@foobar.com",
            "Happy birthday!",
            "Happy Birthday, John Doe!"
        );

        $messageComposer = $this->createMock(MessageCompositionPort::class);
        $messageComposer->expects($this->once())
            ->method('compose')
            ->will($this->returnValue($composedMessage));

        $transmitterMock = $this->createMock(MessageTransmissionPort::class);
        $transmitterMock->expects($this->once())
            ->method('send')
            ->will($this->returnValue(true));

        $useCase = new BirthdayMessageUseCase(
            $repository,
            $messageComposer,
            $transmitterMock
        );

        $this->assertTrue($useCase->sendGreetings($testDate));
    }
}
