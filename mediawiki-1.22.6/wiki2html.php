<?php

include_once('maintenance/commandLine.inc');

$parser = new Parser();
$output = $parser->parse(
  "this is a ''sample''",
  Title::newFromText('title'),
  new ParserOptions()
);

echo $output->getText();

