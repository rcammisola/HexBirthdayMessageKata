<?php

namespace test\Hex\UseCase;

use PHPUnit\Framework\TestCase;
use Hex\UseCase\BirthdayMessageUseCase;

class BirthdayMessageUseCaseTest extends TestCase
{
    public function testUseCaseCreatedSuccessfully()
    {
        $useCase = new BirthdayMessageUseCase();

        $this->assertTrue($useCase->sendGreetings(date()));
    }
}
