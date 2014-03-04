<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

$params = getopt('', array('ext:'));
$ext = $params['ext'];

try {
    $ref = new \ReflectionExtension($ext);
} catch (\ReflectionException $e) {
    if (VERBOSE) {
        trigger_error('"' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '"', E_USER_WARNING);
    }

    die;
}

foreach ($ref->getClassNames() as $class) {
    try {
        $ref = new \ReflectionClass($class);
    } catch (\ReflectionException $e) {
        unset($ref);

        if (VERBOSE) {
            trigger_error('"' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '"', E_USER_WARNING);
        }
    }

    if (isset($ref)) {
        doSave($ref, doClassPrototype($ref));
    }
}
