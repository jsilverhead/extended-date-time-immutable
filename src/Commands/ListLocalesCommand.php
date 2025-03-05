<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListLocalesCommand extends Command
{
    protected function configure(): void
    {
        $this->setName("app:list-locales");
        $this->setDescription("List all locales");
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $path = getcwd() . "/public/locale";

        $localeFiles = glob($path . "/*.json");

        $resultTable = new Table($output);
        $resultTable->setHeaders(["#", "Locale"]);

        foreach ($localeFiles as $key => $localeFile) {
            $localeFile = str_replace(
                ["TimeMeasuresLocale_", ".json"],
                "",
                basename($localeFile)
            );
            $resultTable->addRow([++$key, $localeFile]);
        }

        $resultTable->render();

        return Command::SUCCESS;
    }
}
