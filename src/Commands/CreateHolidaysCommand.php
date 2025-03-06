<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class CreateHolidaysCommand extends Command
{
    protected function configure(): void
    {
        $this->setName("app:create-holidays");
        $this->setDescription("Creates holidays file");
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $isAnyMore = true;

        $questionHelper = $this->getHelper("question");
        $countryQuestion = new Question(
            "Please enter the name of the country: "
        );
        $holidayQuestion = new Question(
            "Please enter the name of the holiday (max 50 characters): "
        );
        $holidayDateQuestion = new Question(
            "Please enter the holiday date (MM.DD): "
        );

        $anyMoreQuestion = new Question(
            "Is any more holidays, you'd like to add ('yes', 'no')? ",
            "yes"
        );

        $holidays = [];

        $countryName = $questionHelper->ask($input, $output, $countryQuestion);

        $expectedAnyMoreAnswer = ["yes", "no", "y", "n"];

        while ($isAnyMore) {
            $isRecognizedAnyMore = false;

            $holidayAnswer = $questionHelper->ask(
                $input,
                $output,
                $holidayQuestion
            );

            try {
                $this->validateAnswer($holidayAnswer);
            } catch (\InvalidArgumentException $e) {
                $output->writeln("<error>{$e->getMessage()}</error>");

                return Command::INVALID;
            }

            $holidayDateAnswer = $questionHelper->ask(
                $input,
                $output,
                $holidayDateQuestion
            );

            try {
                $this->validateDate($holidayDateAnswer);
            } catch (\InvalidArgumentException $e) {
                $output->writeln("<error>{$e->getMessage()}</error>");

                return Command::INVALID;
            }

            $holidays[$holidayDateAnswer] = $holidayAnswer;

            while (!$isRecognizedAnyMore) {
                $anyMoreAnswer = strtolower(
                    $questionHelper->ask($input, $output, $anyMoreQuestion)
                );

                if (in_array($anyMoreAnswer, $expectedAnyMoreAnswer)) {
                    $isRecognizedAnyMore = true;
                }

                if ($anyMoreAnswer === "no" || $anyMoreAnswer === "n") {
                    $isAnyMore = false;
                    break 2;
                }
            }
        }

        $path = getcwd() . "/public/holidays/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $file = $path . $countryName . ".json";

        if (file_exists($file)) {
            $output->writeln("File already exists.");

            return Command::FAILURE;
        }

        try {
            $contentsAsJson = json_encode(
                $holidays,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        } catch (JsonException $e) {
            $output->writeln(
                "<error>JsonException occurred</error>: " . $e->getMessage()
            );

            return Command::INVALID;
        }

        if (file_put_contents($file, $contentsAsJson) === false) {
            $output->writeln("<error>Error in creating the file.</error>");

            return Command::FAILURE;
        }

        $output->writeln("<info>Holidays file created successfully.</info>");

        return Command::SUCCESS;
    }

    private function validateAnswer(string $answer): void
    {
        if ("" === $answer) {
            throw new \InvalidArgumentException("Answer cannot be empty.");
        }

        if (strlen($answer) > 50) {
            throw new \InvalidArgumentException(
                "Answer cannot be longer than 50 characters."
            );
        }
    }

    private function validateDate(string $date): void
    {
        $dateTime = \DateTimeImmutable::createFromFormat("m.d", $date);

        if ($dateTime === false) {
            throw new \InvalidArgumentException("Invalid date.");
        }

        $errors = \DateTimeImmutable::getLastErrors();

        if (
            $errors !== false &&
            ($errors["warning_count"] > 0 || $errors["error_count"] > 0)
        ) {
            throw new \InvalidArgumentException("Invalid date.");
        }
    }
}
