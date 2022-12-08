<?php

declare(strict_types=1);

namespace FW\Core\Component;

use Exception;
use FW\Core\InstanceContainer;
use FW\Core\App;

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
   * @var string $__relativePath url к файловой структуре шаблона
   */
  private string $__relativePath;

  /**
   * @var string $templateId строковый id шаблона
   */
  private string $templateId;

  /**
   * @var Base $component экземляр компонента
   */
  private Base $component;

  /**
   * @var App экземляр приложения для добавления js, css
   */
  private App $app;

  /**
   * В конструкторе мы должны указать жёскую зависимость от
   * компонента
   *
   * @param string $templateId id шаблона
   * @param Base $component инстанс компонента
   */
  public function __construct(string $templateId, Base $component)
  {
    $this->templateId = $templateId;
    $this->component = $component;
    $this->__path = $component->__path . self::TEMPLATE_DIR . $templateId . '/';
    $this->__relativePath = URL_ASSETS . str_replace(':', '/', $this->component->componentId) . '/';

    try {
      if (!file_exists($this->__path)) {
        throw new Exception("Папка шаблона $this->__path не существует!");
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

    $this->app = InstanceContainer::get(App::class);
  }

  /**
   * подключает файл шаблона + стили и js
   *
   * @param string $page страница подключения в шаблоне
   * @return void
   */
  function render(string $page = "template"): void
  {
    try {
      $filenameResultModifier = $this->__path . self::FILENAME_RESULT_MODIFIER;
      $this->includeOptionalTemplateFile($filenameResultModifier);

      $this->includeComponentTemplate($page);

      $filenameComponentEpilog = $this->__path . self::FILENAME_EPILOG;
      $this->includeOptionalTemplateFile($filenameComponentEpilog);

      $this->includeJS();
      $this->includeCSS();

    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Подключает неоябзательные файлы шаблона
   *
   * @param $filePath путь к файлу
   * @return void
   */
  private function includeOptionalTemplateFile(string $filePath)
  {
    if (file_exists($filePath)) {
      include $filePath;
    }
  }

  /**
   * подключает обязательный компонент шаблона на страницу
   *
   * @param string $page страница подключения в шаблоне
   * @return void
   * @throws Exception Шаблон компонета не существует
   */
  private function includeComponentTemplate(string $page)
  {
    if (!file_exists($this->__path . $page . ".php")) {
      throw new Exception("Шаблон компонета {$this->component->componentId} не существует");
    }

    include($this->__path . $page . ".php");
  }

  /**
   * Добавляет файл скрипта js в сборку если такой имеется
   *
   * @return void
   * @throws Exception Файл стрипта компонета не перемещен
   */
  private function includeJS()
  {
    $filenameScript = $this->__path . self::FILENAME_SCRIPT;

    if (file_exists($filenameScript)) {
      $this->app->getSciptsBundler()->addFile($this->component->componentId, $filenameScript);
    }
  }

  /**
   * Добавляет файл стилей css в сборку если такой имеется
   * файл стиля
   *
   * @return void
   * @throws Exception Файл стиля компонета не перемещен
   */
  private function includeCSS()
  {
    $filenameStyle = $this->__path . self::FILENAME_STYLE;

    if (file_exists($filenameStyle)) {
      $this->app->getStylesBundler()->addFile($this->component->componentId, $filenameStyle);
    }
  }

}