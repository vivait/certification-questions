<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

require_once 'vendor/autoload.php';

$finder = new Finder();

$files = $finder->in(__DIR__ . '/data')->files()->name('/.*\.[yml|yaml]/');

foreach ($files as $file) {
    $content = Yaml::parse($file->getContents());

    foreach ($content['questions'] ?? [] as $question) {
        $oneIsCorrect = false;
        $questionText = $question['question'];

        foreach ($question['answers'] as $answer) {

            if ( ! array_key_exists('correct', $answer)) {
                echo "No 'correct' index for: " . $questionText . PHP_EOL;
                continue;
            }

            if ($answer['correct'] === true) {
                $oneIsCorrect = true;
            }

            if ( ! array_key_exists('value', $answer)) {
                echo "No 'value' index for: " . $questionText . PHP_EOL;
                continue;
            }

            if ( ! is_string($answer['value']) && ! is_int($answer['value']) && ! is_float($answer['value'])) {
                echo "'value' index incorrect type: " . $questionText . PHP_EOL;
                continue;
            }
        }

        if ( ! $oneIsCorrect) {
            echo 'no correct answer for: ' . $questionText . PHP_EOL;
        }
    }

    file_put_contents(
        $file->getRealPath(),
        Yaml::dump($content, 5, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK)
    );
}
