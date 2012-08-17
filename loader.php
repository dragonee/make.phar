<?php

$phar_path = Phar::running(false);
$phar_dir = dirname($phar_path);

$phar = new Phar($phar_path);
$phar->extractTo($phar_dir, null, true);

unlink($phar_dir . '/__loader.php');
unlink($phar_path);

echo 'ok';
