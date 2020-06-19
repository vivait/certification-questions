<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

require_once 'vendor/autoload.php';

$finder = new Finder();

$files = $finder->in(__DIR__ . '/data')->files()->name('/.*\.[yml|yaml]/');

foreach ($files as $file) {
    file_put_contents(
        $file->getRealPath(),
        Yaml::dump(Yaml::parse($file->getContents()), 5, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK)
    );
}
