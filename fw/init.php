<?php

declare(strict_types=1);

use FW\Core\App;
use FW\Core\Config;

session_start();

define('FW_CORE_INCLUDE', true);

//function debugger
require 'libs/helpers/index.php';

define('ROOT', __DIR__);
define('ROOT_TEMLATES', __DIR__ . '/templates/');
define('ROOT_COMPONENTS', __DIR__ . '/components/');

spl_autoload_register(function ($class) {

    $file = ROOT . '/' . str_replace('FW\\', '/', $class) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});


