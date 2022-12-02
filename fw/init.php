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
define('ROOT_ASSETS_JS', dirname(__DIR__) . '/public/assets/components/js/');
define('ROOT_ASSETS_CSS', dirname(__DIR__) . '/public/assets/components/css/');
define('URL_ASSETS_JS', __DIR__ . '/assets/js/');
define('URL_ASSETS_CSS', '/assets/css/');

if (!(is_dir(ROOT_ASSETS_CSS))) {
  mkdir(ROOT_ASSETS_CSS, 0777, true);
}

if (!(is_dir(ROOT_ASSETS_JS))) {
  mkdir(ROOT_ASSETS_JS, 0777, true);;
}


spl_autoload_register(function ($class) {

  $file = ROOT . '/' . str_replace('FW\\', '/', $class) . '.php';

  if (is_file($file)) {
    require_once $file;
  }
});


