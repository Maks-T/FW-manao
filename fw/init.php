<?php

declare(strict_types=1);

use FW\Core\App;
use FW\Core\Config;

session_start();

define('FW_CORE_INCLUDE', true);

//function debugger
require 'libs/helpers/dd.php';

define('ROOT', __DIR__);

spl_autoload_register(function ($class) {

  $file = ROOT . '/' . str_replace('FW\\', '/', $class) . '.php';

  if (is_file($file)) {
    require_once $file;
  }
});

$app = App::getInstance();
$app->addPage('asdasdasdasd');


dd($app);
$config = Config::get('db/login');
dd($config['db']['login']);
