<?php
include __DIR__ . '/../vendor/autoload.php';
$markdown = file_get_contents('markdown.md');
$parser = new \cebe\markdown\Markdown();
echo $parser->parse($markdown);