<?php

declare(strict_types=1);

namespace FW\Core\Component;

class Template
{
  const FILENAME_RESULT_MODIFIER = 'result_modifier.php';
  const FILENAME_EPILOG = 'component_epilog.php';
  const FILENAME_SCRIPT = 'script.js';
  const FILENAME_STYLE = 'style.css';
  const TEMPLATE_DIR = '/templates/';

  /**
   * @var string $__path путь к файловой структуре шаблона
   */
  private string $__path;

  /**
   * @var string $__relativeScriptPath url скрипта к файловой структуре шаблона
   */
  private string $__relativeScriptPath;

  /**
   * @var string $__relativeStylePath url стиля к файловой структуре шаблона
   */
  private string $__relativeStylePath;

  /**
   * @var string $templateId строковый id шаблона
   */
  private string $templateId;

  /**
   * @var Base $component экземляр компонента
   */

  private Base $component;

  /**
   * @param string $templateId id шаблона
   * @param Base $component инстанс компонента
   * В конструкторе мы должны указать жёскую зависимость от
   * компонента
   */
  public function __construct(string $templateId, Base $component)
  {
    $this->templateId = $templateId;
    $this->component = $component;
    $this->__path = realpath($component->__path . self::TEMPLATE_DIR . $templateId);

    $this->__relativeScriptPath = URL_ASSETS_JS . $this->component->componentId . '.' . self::FILENAME_SCRIPT;
    $this->__relativeStylePath = URL_ASSETS_CSS . $this->component->componentId . '.' . self::FILENAME_STYLE;

    try {
      if (!file_exists($this->__path)) {
        throw new \Exception("Папка $this->__path не существует!");
      }


    } catch (\Exception $e) {
      echo $e->getMessage();
    }

  }

  /**
   * @param string $page страница подключения в шаблоне
   * @return void
   *
   *  подключает файл шаблона + стили и js
   */
  function render(string $page = "template"): void
  {
    $filenameResultModifier = $this->__path . '/' . self::FILENAME_RESULT_MODIFIER;
    $filenameComponentEpilog = $this->__path . '/' . self::FILENAME_EPILOG;
    $filenameScript = $this->__path . '/' . self::FILENAME_SCRIPT;
    $filenameStyle = $this->__path . '/' . self::FILENAME_STYLE;
    $filenameComponentId = str_replace(':', '.', $this->component->componentId);
    $scriptPathAsset = ROOT_ASSETS_JS . $filenameComponentId . '.' .self::FILENAME_SCRIPT;
    $stylePathAsset = ROOT_ASSETS_CSS . $filenameComponentId . '.' .self::FILENAME_STYLE;


    try {
      if (file_exists($filenameResultModifier)) {
        include $filenameResultModifier;
      }

      if (!file_exists($this->__path . '/' . $page . ".php")) {
        throw new \Exception("Шаблон компонета {$this->component->componentId} не существует");
      }

      include($this->__path . '/' . $page . ".php");

      if (file_exists($filenameComponentEpilog)) {
        include $filenameComponentEpilog;
      }

      if (file_exists($filenameScript)) {
        if (!copy($filenameScript, $scriptPathAsset)) {
          throw new \Exception("Файл стрипта компонета {$this->component->componentId} не перемещен");
        }
      }

      if (file_exists($filenameStyle)) {
        if (!copy($filenameStyle, $stylePathAsset)) {
          throw new \Exception("Файл стиля компонента {$this->component->componentId} не перемещен");
        }
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

}
