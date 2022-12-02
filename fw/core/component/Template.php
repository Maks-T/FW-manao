<?php

declare(strict_types=1);

namespace FW\Core\Component;

class Template
{

  /*
  * В конструкторе мы должны указать жёскую зависимость от
  * компонента
  *
  */
  public function __construct(string $id, Base $component)
  {
  }

  /*
  * string $__path
  * путь к файловой структуре шаблона
  */

  private string $__path;
  /*
  * string $__relativePath
  * url к файловой структуре шаблона
  */

  private string $__relativePath;

  /*
  * string $id
  * строковый id шаблона
  */
  private string $id;

  /*
  * должен подключать файл шаблона
  * + стили и js
  * $page - страница подключения в шаблоне
  *
  */
  function render(string $page = "template")
  {
  }

}
