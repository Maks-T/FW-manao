<?php

declare(strict_types=1);

namespace FW\Core\Component;

abstract class Base
{
  /*
  * array $result
  * массив с результатом работы комопнента
  */
  public array $result;

  /*
  * string $id
  строковый id компонента
  */
  public string $id;

  /*
  * array $params
  * входящие параметры компонента
  */
  public array $params;

  /*
  * Template $template
  * экземпляр класса шаблона компонента
  */
  public ?Template $template;

  /*
  * string $__path
  * путь к файловой структуре компонента
  */
  public string $__path;

  public function __construct()
  {
  }

  abstract public function executeComponent();

}