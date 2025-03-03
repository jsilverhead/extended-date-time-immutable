<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateLocaleCommand extends Command
{
    protected function configure()
    {
        $this->setName("app:create-locale");
        $this->setDescription("Create a new locale");
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        /** @psalm-var QuestionHelper $helper */
        $questionHelper = $this->getHelper("question");
        $localeNameQuestion = new Question(
            "Add locale name (1-4 letters max): "
        );
        $yearSingularQuestion = new Question(
            "How the year is called in singular (10 letters max):"
        );
        $yearPluralQuestion = new Question(
            "How the year is called in plural (10 letters max):"
        );
        $monthSingularQuestion = new Question(
            "How the month is called in singular (10 letters max):"
        );
        $monthPluralQuestion = new Question(
            "How the month is called in plural (10 letters max):"
        );
        $daySingularQuestion = new Question(
            "How the day is called in singular (10 letters max):"
        );
        $dayPluralQuestion = new Question(
            "How the day is called in plural (10 letters max):"
        );
        $hourSingularQuestion = new Question(
            "How the hour is called in singular (10 letters max):"
        );
        $hourPluralQuestion = new Question(
            "How the hour is called in plural (10 letters max):"
        );
        $minuteSingularQuestion = new Question(
            "How the minute is called in singular (10 letters max):"
        );
        $minutePluralQuestion = new Question(
            "How the minute is called in plural (10 letters max):"
        );
        $secondSingularQuestion = new Question(
            "How the second is called in singular (10 letters max):"
        );
        $secondPluralQuestion = new Question(
            "How the second is called in plural (10 letters max):"
        );

        $output->writeln("<info>Create a new time measure locale</info>");
        $localeName = $questionHelper->ask(
            $input,
            $output,
            $localeNameQuestion
        );

        if (empty($localeName)) {
            $output->writeln("<error>Locale name can't be empty</error>");
            return Command::FAILURE;
        }

        if (
            !is_string($localeName) ||
            strlen($localeName) < 1 ||
            strlen($localeName) > 4
        ) {
            $output->writeln("<error>Locale name is invalid</error>");
            return Command::FAILURE;
        }

        $yearSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $yearSingularQuestion
        );

        $this->validateLocale(locale: $yearSingularAnswer, output: $output);

        $yearPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $yearPluralQuestion
        );

        $this->validateLocale(locale: $yearPluralAnswer, output: $output);

        $monthSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $monthSingularQuestion
        );

        $this->validateLocale(locale: $monthSingularAnswer, output: $output);

        $monthPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $monthPluralQuestion
        );

        $this->validateLocale(locale: $monthPluralAnswer, output: $output);

        $daySingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $daySingularQuestion
        );

        $this->validateLocale(locale: $daySingularAnswer, output: $output);

        $dayPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $dayPluralQuestion
        );

        $this->validateLocale(locale: $dayPluralAnswer, output: $output);

        $hourSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $hourSingularQuestion
        );

        $this->validateLocale(locale: $hourSingularAnswer, output: $output);

        $hourPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $hourPluralQuestion
        );

        $this->validateLocale(locale: $hourPluralAnswer, output: $output);

        $minuteSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $minuteSingularQuestion
        );

        $this->validateLocale(locale: $minuteSingularAnswer, output: $output);

        $minutePluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $minutePluralQuestion
        );

        $this->validateLocale(locale: $minutePluralAnswer, output: $output);

        $secondSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $secondSingularQuestion
        );

        $this->validateLocale(locale: $secondSingularAnswer, output: $output);

        $secondPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $secondPluralQuestion
        );

        $this->validateLocale(locale: $secondPluralAnswer, output: $output);

        $contents = [
            "years" => [
                "singular" => $yearSingularAnswer,
                "plural" => $yearPluralAnswer,
            ],
            "months" => [
                "singular" => $monthSingularAnswer,
                "plural" => $monthSingularAnswer,
            ],
            "days" => [
                "singular" => $daySingularAnswer,
                "plural" => $dayPluralAnswer,
            ],
            "hours" => [
                "singular" => $hourSingularAnswer,
                "plural" => $hourPluralAnswer,
            ],
            "minutes" => [
                "singular" => $minuteSingularAnswer,
                "plural" => $minutePluralAnswer,
            ],
            "seconds" => [
                "singular" => $minuteSingularAnswer,
                "plural" => $minutePluralAnswer,
            ],
        ];

        $directory = getcwd() . "/public/locale";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $file = $directory . "/TimeMeasuresLocale_" . $localeName . ".json";

        file_put_contents(
            $file,
            json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        $output->writeln("<info>Locale successfully created</info>");
        return Command::SUCCESS;
    }

    private function validateLocale(
        string $locale,
        OutputInterface $output
    ): ?int {
        if (empty($locale)) {
            $output->writeln("<error>Locale can not be empty</error>");
            return Command::FAILURE;
        }

        if (!is_string($locale)) {
            $output->writeln("<error>Locale should be a string</error>");

            return Command::FAILURE;
        }

        if (strlen($locale) < 1 || strlen($locale) > 10) {
            $output->writeln(
                "<error>Locale can not less than 1 and bigger than 10 letters long</error>"
            );
            return Command::FAILURE;
        }

        return null;
    }
}
