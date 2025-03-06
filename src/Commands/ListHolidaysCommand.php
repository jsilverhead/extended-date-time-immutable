<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class ListHolidaysCommand extends Command
{
    protected function configure(): void
    {
        $this->setName("app:list-holidays");
        $this->setDescription("List holidays");

        $this->addArgument("Country", InputArgument::REQUIRED);
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $path = getcwd() . "/public/holidays/";

        if (!is_dir($path)) {
            $output->writeln("<error>Path do not exist: </error>" . $path);

            return Command::FAILURE;
        }

        $file = $path . $input->getArgument("Country") . ".json";

        if (!is_file($file)) {
            $output->writeln("<error>File do not exist: </error>" . $file);

            return Command::FAILURE;
        }

        $contentsAsJson = file_get_contents($file);

        if (empty($contentsAsJson)) {
            $output->writeln("<error>File is empty </error>" . $file);

            return Command::FAILURE;
        }

        try {
            $contentsAsArray = json_decode($contentsAsJson, true);
        } catch (JsonException $e) {
            $output->writeln(
                "<error>Json parse error: </error>" . $e->getMessage()
            );

            return Command::INVALID;
        }

        $resultTable = new Table($output);
        $resultTable->setHeaders(["Date", "Celebrations"]);

        foreach ($contentsAsArray as $date => $holiday) {
            $resultTable->addRow([$date, $holiday]);
        }

        $resultTable->render();

        return Command::SUCCESS;
    }
}
