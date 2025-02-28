<?php

namespace App\Tests\Functional\Locale;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateLocaleCommandTest extends KernelTestCase
{
    public function testCreateLocaleSuccess(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $command = $application->find("app:create-locale");
        $commandTester = new CommandTester($command);

        $commandTester->setInputs([
            "bg",
            "year",
            "years",
            "month",
            "months",
            "week",
            "weeks",
            "weeks",
            "day",
            "days",
            "hour",
            "hours",
            "minute",
            "minutes",
            "second",
            "seconds",
        ]);

        $commandTester->execute([]);

        $this->assertSame(expected: 0, actual: $commandTester->getStatusCode());
    }
}
