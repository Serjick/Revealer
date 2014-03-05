<?php

$path_autoloader = DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$path_parent = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

if (is_file(__DIR__ . $path_parent . $path_autoloader)) {
    require __DIR__ . $path_parent . $path_autoloader;
} else {
    require __DIR__ . $path_autoloader;
}

require __DIR__ . DIRECTORY_SEPARATOR . 'core.functions.php';

define('PHP_OPEN_TAG', '<?php');
define('VERBOSE', array_key_exists('verbose', getopt('', array('verbose'))));
define('UNKNOWN_DEFAULT_VALUE', null);
