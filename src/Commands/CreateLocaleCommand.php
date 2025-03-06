<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateLocaleCommand extends Command
{
    protected function configure(): void
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
        $januaryQuestion = new Question(
            "How January is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $februaryQuestion = new Question(
            "How February is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $marchQuestion = new Question(
            "How March is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $aprilQuestion = new Question(
            "How April is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $mayQuestion = new Question(
            "How May is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $juneQuestion = new Question(
            "How June is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $julyQuestion = new Question(
            "How July is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $augustQuestion = new Question(
            "How August is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $septemberQuestion = new Question(
            "How September is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $octoberQuestion = new Question(
            "How October is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $novemberQuestion = new Question(
            "How November is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );
        $decemberQuestion = new Question(
            "How December is called in this language (with spaces if necessary. ex: ' de janeiro'):"
        );

        $output->writeln("<info>Create a new time measure locale</info>");
        $localeName = $questionHelper->ask(
            $input,
            $output,
            $localeNameQuestion
        );

        try {
            $this->validateLocaleName(name: $localeName);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $yearSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $yearSingularQuestion
        );

        try {
            $this->validateLocale(locale: $yearSingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $yearPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $yearPluralQuestion
        );

        try {
            $this->validateLocale(locale: $yearPluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $monthSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $monthSingularQuestion
        );

        try {
            $this->validateLocale(locale: $monthSingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $monthPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $monthPluralQuestion
        );

        try {
            $this->validateLocale(locale: $monthPluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $daySingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $daySingularQuestion
        );

        try {
            $this->validateLocale(locale: $daySingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $dayPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $dayPluralQuestion
        );

        try {
            $this->validateLocale(locale: $dayPluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $hourSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $hourSingularQuestion
        );

        try {
            $this->validateLocale(locale: $hourSingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $hourPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $hourPluralQuestion
        );

        try {
            $this->validateLocale(locale: $hourPluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $minuteSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $minuteSingularQuestion
        );

        try {
            $this->validateLocale(locale: $minuteSingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $minutePluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $minutePluralQuestion
        );

        try {
            $this->validateLocale(locale: $minutePluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $secondSingularAnswer = $questionHelper->ask(
            $input,
            $output,
            $secondSingularQuestion
        );

        try {
            $this->validateLocale(locale: $secondSingularAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $secondPluralAnswer = $questionHelper->ask(
            $input,
            $output,
            $secondPluralQuestion
        );

        try {
            $this->validateLocale(locale: $secondPluralAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $januaryAnswer = $questionHelper->ask(
            $input,
            $output,
            $januaryQuestion
        );

        try {
            $this->validateLocale(locale: $januaryAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $februaryAnswer = $questionHelper->ask(
            $input,
            $output,
            $februaryQuestion
        );

        try {
            $this->validateLocale(locale: $februaryAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $marchAnswer = $questionHelper->ask($input, $output, $marchQuestion);

        try {
            $this->validateLocale(locale: $marchAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $aprilAnswer = $questionHelper->ask($input, $output, $aprilQuestion);

        try {
            $this->validateLocale(locale: $aprilAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $mayAnswer = $questionHelper->ask($input, $output, $mayQuestion);

        try {
            $this->validateLocale(locale: $mayAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $juneAnswer = $questionHelper->ask($input, $output, $juneQuestion);

        try {
            $this->validateLocale(locale: $juneAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $julyAnswer = $questionHelper->ask($input, $output, $julyQuestion);

        try {
            $this->validateLocale(locale: $julyAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $augustAnswer = $questionHelper->ask($input, $output, $augustQuestion);

        try {
            $this->validateLocale(locale: $augustAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $septemberAnswer = $questionHelper->ask(
            $input,
            $output,
            $septemberQuestion
        );

        try {
            $this->validateLocale(locale: $septemberAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $octoberAnswer = $questionHelper->ask(
            $input,
            $output,
            $octoberQuestion
        );

        try {
            $this->validateLocale(locale: $octoberAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $novemberAnswer = $questionHelper->ask(
            $input,
            $output,
            $novemberQuestion
        );

        try {
            $this->validateLocale(locale: $novemberAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

        $decemberAnswer = $questionHelper->ask(
            $input,
            $output,
            $decemberQuestion
        );

        try {
            $this->validateLocale(locale: $decemberAnswer);
        } catch (\InvalidArgumentException $e) {
            $output->writeln(
                "<error>Invalid locale</error>: " . $e->getMessage()
            );
            return Command::INVALID;
        }

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
                "singular" => $secondSingularAnswer,
                "plural" => $secondPluralAnswer,
            ],
            "january" => $januaryAnswer,
            "february" => $februaryAnswer,
            "march" => $marchAnswer,
            "april" => $aprilAnswer,
            "may" => $mayAnswer,
            "june" => $juneAnswer,
            "july" => $julyAnswer,
            "august" => $augustAnswer,
            "september" => $septemberAnswer,
            "october" => $octoberAnswer,
            "november" => $novemberAnswer,
            "december" => $decemberAnswer,
        ];

        $path = getcwd() . "/public/locale/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $file = $path . "TimeMeasuresLocale_" . $localeName . ".json";

        if (file_exists($file)) {
            $output->writeln("<error>Locale file already exists.</error>");

            return Command::FAILURE;
        }

        if (
            file_put_contents(
                $file,
                json_encode(
                    $contents,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                )
            ) === false
        ) {
            $output->writeln("<error>Failed to write locale file</error>");
            return self::FAILURE;
        }

        $output->writeln("<info>Locale successfully created</info>");
        return Command::SUCCESS;
    }

    private function validateLocale(string $locale): void
    {
        if ("" === $locale) {
            throw new \InvalidArgumentException("Locale can't be empty");
        }

        if (strlen($locale) < 1 || strlen($locale) > 10) {
            throw new \InvalidArgumentException(
                "Locale length must be between 1 and 10 characters"
            );
        }
    }

    private function validateLocaleName(string $name): void
    {
        if ("" === $name) {
            throw new \InvalidArgumentException("Locale name can not be empty");
        }

        if (strlen($name) < 1 || strlen($name) > 4) {
            throw new \InvalidArgumentException(
                "Locale name length must be between 1 and 4 characters"
            );
        }
    }
}
