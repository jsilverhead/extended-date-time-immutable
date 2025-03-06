<?php

namespace App\Tests\Functional\Holidays;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateHolidaysCommandTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $command = $application->find("app:create-holidays");
        $commandTester = new CommandTester($command);

        $commandTester->setInputs(["Russia", "9 мая", "05.09", "n"]);

        $commandTester->execute([]);

        $this->assertSame(0, $commandTester->getStatusCode());

        unlink(getcwd() . "/public/holidays/Russia.json");
    }
}
