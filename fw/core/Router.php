<?php

declare(strict_types=1);

namespace FW\Core;

class Router
{
  private static array $routes = [];

  private function __construct()
  {
  }

  public static function match(string $requestUri)
  {
    if (empty(self::$routes)) {
      self::$routes = require_once ROOT . '\routes.php';
    }
  }
}