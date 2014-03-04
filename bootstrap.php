<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'core.functions.php';

define('PHP_OPEN_TAG', '<?php');
define('VERBOSE', array_key_exists('verbose', getopt('', array('verbose'))));
define('UNKNOWN_DEFAULT_VALUE', null);
