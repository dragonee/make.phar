<?php

$doc = <<<EOD
Make self-extracting phar archive from a directory.

Usage:
  make-phar.php [options] DIRECTORY [PHAR]

Options:
  --entry=ENTRY Load specific file instead of extracting the package.
  --shebang     Make this archive executable with a shebang.
  -h, --help    Show this message.
  --version     Show version.
EOD;

require "docopt/src/docopt.php";

$args = Docopt\docopt($doc, array('version' => 'make-phar 0.9'));

if(!Phar::canWrite()) {
    fprintf(STDERR, "Phar writing support is not enabled in php.ini. Please set phar.readonly to 0.\n");
    exit(1);
}

$directory = $args['DIRECTORY'];
if(!file_exists($directory)) {
    fprintf(STDERR, "Directory $directory does not exist.\n");
    exit(1);
}

if(!is_dir($directory)) {
    fprintf(STDERR, "File $directory is not a directory.\n");
    exit(1);
}

$directory = realpath($directory);

$output_filename = $args['PHAR'];
if(!$output_filename) {
    $output_filename = $directory . '.phar';
}

$phar = new Phar($output_filename);

$phar->startBuffering();
$phar->buildFromIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)), $directory);

$entry = $args['--entry'];

if(!$entry) {
    $phar['__loader.php'] = file_get_contents('loader.php');
    
    $entry = '__loader.php';
}

$stub = $phar->createDefaultStub($entry, $entry);

if($args['--shebang']) {
    $stub = "#!/usr/bin/env php\n" . $stub;
}

$phar->setStub($stub);

$phar->stopBuffering();



