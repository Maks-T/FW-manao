<?php

declare(strict_types=1);

use FW\Core\App;
use FW\Core\Config;

session_start();

define('FW_CORE_INCLUDE', true);

//include libs functions
require 'libs/index.php';

define('ROOT', __DIR__);
define('ROOT_TEMLATES', __DIR__ . '/templates/');
define('ROOT_COMPONENTS', __DIR__ . '/components/');
define('ROOT_ASSETS', dirname(__DIR__) . '/public/assets');
define('URL_ASSETS', './assets/');
define('ROOT_CACHE', dirname(__DIR__) . '/cache/');

if (!(is_dir(ROOT_CACHE))) {
  mkdir(ROOT_CACHE, 0777, true);
}

spl_autoload_register(function ($class) {

  $file = ROOT . '/' . str_replace('FW\\', '/', $class) . '.php';

  if (is_file($file)) {
    require_once $file;
  }
});


