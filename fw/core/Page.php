<?php

declare(strict_types=1);

namespace FW\Core;

class Page extends Multiton
{
  const FW_MACRO_CSS = '#FW_MACRO_CSS#';
  const FW_MACRO_JS = '#FW_MACRO_JS#';
  const FW_MACRO_STR = '#FW_MACRO_STR#';

  private $properties = [];

  private $scripts = [];

  private $links = [];

  private $strings = [];

  protected function __construct()
  {   
  }

  //добавляет src в массив сохраняя уникальность
  public function addJs(string $src)
  {
    addUniqueStrToArray($src, $this->scripts);
  }
  
  //добавляет link сохраняя уникальность
  public function addCss(string $link)
  {
    addUniqueStrToArray($link, $this->links);
  }
  
  // добавляет в массив для хранения
  public function addString(string $str)
  {
    addUniqueStrToArray($str, $this->strings);
  }
  
  // добавляет для хранениезначение по ключу
  public function setProperty(string $id, mixed $value)
  {
     $this->properties[$this->getPropMacro($id)] = $value . '\r\n';
  }
  
  // получение по ключу
  public function getProperty(string $id)
  {
     return isset($this->properties[$this->getPropMacro($id)]) ? $this->properties[$this->getPropMacro($id)] : null;
  }

  // выводит макрос для будущей замены
  public function showProperty(string $id)
  {
    echo !is_null($this->getProperty($id)) ? $this->getPropMacro($id) : '';   
  }

  // получает массив макросов и значений для замены
  public function getAllReplace()
  {
    $replaces[self::FW_MACRO_CSS] = implode('', array_map(fn($src) => "<script src=\"{$src}\"></script>\r\n", $this->scripts));
    $replaces[self::FW_MACRO_JS] = implode('', array_map(fn($link) => "<link href=\"{$link}\" rel=\"stylesheet\">\r\n", $this->links));
    $replaces[self::FW_MACRO_STR] = implode('', array_map(fn($src) => $str. '\r\n', $this->strings));    

    return array_merge($replaces, $this->properties);
  }
   // выводит 3 макроса замены CSS / STR / JS
  public function showHead()
  {
    echo self::FW_MACRO_CSS;
    echo self::FW_MACRO_JS;
    echo self::FW_MACRO_STR;
  }

  private function getPropMacro($id) {

    return "#FW_PAGE_PROPERY_{$id}#";
  }  
}
