<?php

declare(strict_types=1);

namespace FW\Core;

class Config
{
  private static array $data = [];

  private function __construct()
  {
  }

  public static function get(string $path)
  {
    if (empty(self::$data)) {
      self::$data = require_once ROOT . '\config.php';
    }

    $keys = explode('/', $path);
    $config = self::$data;

    foreach ($keys as $key) {
      $config = $config[$key];
    }

    return $config = self::$data;;
  }
}
