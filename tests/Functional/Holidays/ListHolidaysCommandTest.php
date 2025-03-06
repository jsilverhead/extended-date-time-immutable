<?php

namespace App\Tests\Functional\Holidays;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ListHolidaysCommandTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $command = $application->find("app:list-holidays");
        $commandTester = new CommandTester($command);

        $commandTester->execute(["Country" => "Russia"]);

        $commandTester->assertCommandIsSuccessful();
    }
}
