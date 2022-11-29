<?php

declare(strict_types=1);

session_start();

//function debugger
require 'libs/helpers/dd.php';

define('ROOT', __DIR__);

spl_autoload_register(function ($class) {

  $file = ROOT . '/' . str_replace('FW\\', '/', $class) . '.php';

  if (is_file($file)) {
    require_once $file;
  }
});