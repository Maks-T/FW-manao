<?php

declare(strict_types=1);

namespace FW\Core;

class Page
{
  const FW_MACRO_CSS = '#FW_MACRO_CSS#';
  const FW_MACRO_JS = '#FW_MACRO_JS#';
  const FW_MACRO_STR = '#FW_MACRO_STR#';

  /**
   * @var array $properties массив свойсв
   */
  private array $properties = [];

  /**
   * @var array $scripts массив src скриптов
   */
  private array $scripts = [];

  /**
   * @var array $links массив links
   */
  private array $links = [];

  /**
   * @var array $strings массив строк
   */
  private array $strings = [];

  /**
   * добавляет src в массив сохраняя уникальность
   * @param string $src
   * @return void
   */
  public function addJs(string $src): void
  {
    addUniqueStrToArray($src, $this->scripts);
  }

  /**
   * добавляет link сохраняя уникальность
   * @param string $link
   * @return void
   */
  public function addCss(string $link): void
  {
    addUniqueStrToArray($link, $this->links);
  }

  /**
   * добавляет строку в массив для хранения
   * @param string $str
   * @return void
   */
  public function addString(string $str): void
  {
    addUniqueStrToArray($str, $this->strings);
  }

  /**
   * добавляет для хранение значение по ключу
   * @param string $id
   * @param mixed $value
   * @return void
   */
  public function setProperty(string $id, mixed $value): void
  {
    $this->properties[$this->getPropMacro($id)] = $value . '\r\n';
  }

  /**
   * получение значения по ключу
   * @param string $id
   * @return string|null
   */
  public function getProperty(string $id): ?string
  {
    return $this->properties[$this->getPropMacro($id)] ?? null;
  }

  /**
   * выводит макрос для будущей замены
   * @param string $id
   * @return void
   */
  public function showProperty(string $id): void
  {
    echo !is_null($this->getProperty($id)) ? $this->getPropMacro($id) : '';
  }

  /**
   * получает массив макросов и значений для замены
   * @return array
   */
  public function getAllReplace(): array
  {
    $replaces[self::FW_MACRO_CSS] = implode('',
      array_map(fn($src) => "<script src=\"{$src}\"></script>\r\n", $this->scripts));
    $replaces[self::FW_MACRO_JS] = implode('',
      array_map(fn($link) => "<link href=\"{$link}\" rel=\"stylesheet\">\r\n", $this->links));

    $replaces[self::FW_MACRO_STR] = implode('', array_map(fn($str) => $str . '\r\n', $this->strings));

    return array_merge($replaces, $this->properties);
  }

  /**
   * выводит 3 макроса замены CSS / STR / JS
   * @return void
   */
  public function showHead(): void
  {
    echo self::FW_MACRO_CSS;
    echo self::FW_MACRO_JS;
    echo self::FW_MACRO_STR;
  }

  /**
   * возвражает строку макроса свойства
   * @param $id
   * @return string
   */
  private function getPropMacro($id): string
  {
    return "#FW_PAGE_PROPERY_{$id}#";
  }
}
