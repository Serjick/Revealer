<?php

/**
 * @param \ReflectionClass $class
 * @return string
 */
function doClassPrototype(\ReflectionClass $class)
{
    $code = doView('class', array('class' => $class));
    $parser = new \PHPParser_Parser(new \PHPParser_Lexer());

    try {
        $stmts = $parser->parse($code);
    } catch (\PhpParser_Error $e) {
        if (VERBOSE) {
            trigger_error('"' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '"', E_USER_WARNING);
        }
    }

    if (!empty($stmts)) {
        $printer = new \PHPParser_PrettyPrinter_Default();
        $code = PHP_OPEN_TAG . PHP_EOL . PHP_EOL . $printer->prettyPrint($stmts);
    }

    return $code;
}

/**
 * @param \ReflectionClass $class
 * @param string $code
 * @return bool
 */
function doSave(\ReflectionClass $class, $code)
{
    $dir = __DIR__ . DIRECTORY_SEPARATOR . 'revelations' . DIRECTORY_SEPARATOR;

    if ($path = $class->getNamespaceName()) {
        $dir .= str_replace('\\', DIRECTORY_SEPARATOR, $path) . DIRECTORY_SEPARATOR;
    }

    if (!is_dir($dir)) {
        mkdir($dir, 0744, true);
    }

    return (bool) file_put_contents($dir . $class->getShortName() . '.php', $code);
}

/**
 * @param string $view
 * @param array $_context
 * @return string|null
 */
function doView($view, array $_context = array())
{
    extract($_context);
    ob_start();

    try {
        require __DIR__ . DIRECTORY_SEPARATOR . sprintf('view.%s.php', $view);
    } catch (\Exception $e) {
        ob_end_clean();

        if (VERBOSE) {
            trigger_error('"' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '"', E_USER_WARNING);
        }

        return null;
    }

    $result = ob_get_contents();
    ob_end_clean();

    return $result;
}
