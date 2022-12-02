<?php

declare(strict_types=1);

namespace FW\Core;

class InstanceContainer
{
  private static array $instances = [];

  public static function get(string $class, ...$args)
  {
    if (empty(self::$instances[$class])) {
      self::$instances[$class] = new $class(...$args);
    }

    return self::$instances[$class];
  }

  private function __clone()
  {
  }

  private function __construct()
  {
  }
}
