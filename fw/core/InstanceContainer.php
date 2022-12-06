<?php

declare(strict_types=1);

namespace FW\Core;

class InstanceContainer
{
  private static array $instances = [];

  /**
   * создает и возвращает экземляр класса
   * если такой экземляр существует
   * возвращает существующий экземляр
   * @param string $class имя класса
   * @param ...$args аргументы для конструктора
   * @return mixed экземляр класса
   */
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
