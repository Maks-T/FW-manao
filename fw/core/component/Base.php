<?php

declare(strict_types=1);

namespace FW\Core\Component;

abstract class Base
{

  /**
   * @var array $result
   * массив с результатом работы комопнента
   */
  public array $result;

  /**
   * @var string $componentId
   * строковый id компонента
   */
  public string $componentId;

  /**
   * @var array $params
   * входящие параметры компонента
   */
  public array $params;

  /**
   * @var Template|null $template
   * экземпляр класса шаблона компонента
   */
  public ?Template $template;

  /**
  * string $__path
  * путь к файловой структуре компонента
  */
  public string $__path;

  abstract public function executeComponent();

  /**
   * @param string $componentId id строковый id компонента
   * @param string $templateId id строковый id шаблона
   * @param array $params входящие параметры компонента
   * @param string $path путь к файловой структуре компонента
   */
  public function __construct(
    string $componentId,
    string $templateId,
    array $params,
    string $path
  ) {
    $this->componentId = $componentId;
    $this->params = $params;
    $this->__path = $path;

    $this->template = new Template($templateId, $this);
    $this->template->render();
  }

}