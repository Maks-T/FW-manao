<?php

declare(strict_types=1);

namespace FW\Core;


use FW\Core\Config;


class App
{
  private $pager = null;

  private static $instance = null;

  private $template = null;

  private function __construct()
  {
    dd(Config::get('db/login'));
  }

  public static function getInstance()
  {
    if (null === self::$instance) {
      self::$instance = new static();
    }
    return self::$instance;
  }
}
