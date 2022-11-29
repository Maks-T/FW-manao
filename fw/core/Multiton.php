<?php

declare(strict_types=1);

namespace FW\Core;

class Multiton
{

  private static array $instances = [];

  public static function getInstance(string $class = null): self
  {
    $class = $class ?? get_called_class();

    if (empty(self::$instances[$class])) {
      self::$instances[$class] = new static();
    }

    return self::$instances[$class];
  }

  private function __clone()
  {
  }

  protected function __construct()
  {
  }
}
