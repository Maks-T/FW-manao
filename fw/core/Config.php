<?php

declare(strict_types=1);

namespace FW\Core;

class Config
{
  const FILE_CONFIG = '\config.php';

  /**
   * @var array $data данные из файла конфигурации
   */
  private static array $data = [];

  private function __construct()
  {
  }

  /**
   * @param string $path строка типа 'login/id';
   * @return array|mixed значение параметра конфигурации
   */
  public static function get(string $path)
  {
    if (empty(self::$data)) {
      self::$data = require_once ROOT . self::FILE_CONFIG;
    }

    $keys = explode('/', $path);
    $config = self::$data;

    foreach ($keys as $key) {
      $config = $config[$key];
    }

    return $config;
  }
}
