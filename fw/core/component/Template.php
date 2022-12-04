<?php

declare(strict_types=1);

namespace FW\Core\Component;

use Exception;
use FW\Core\InstanceContainer;
use FW\Core\Page;

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
   * @var Page экземляр страницы для добавления js, css
   */
  private Page $page;

  /**
   * В конструкторе мы должны указать жёскую зависимость от
   * компонента
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

    $this->page = InstanceContainer::get(Page::class);
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
      $this->includeResultModifier();
      $this->includeComponentTemplate($page);
      $this->includeComponentEpilog();
      $this->includeAssets($page);

    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   * подключает файл для модификации
   * данных работы компонента
   * если файл существует
   *
   * @return void
   */
  private function includeResultModifier()
  {
    $filenameResultModifier = $this->__path . self::FILENAME_RESULT_MODIFIER;

    if (file_exists($filenameResultModifier)) {
      include $filenameResultModifier;
    }
  }

  /**
   * подключает файл эпилога компонета
   * если файл существует
   *
   * @return void
   */
  private function includeComponentEpilog()
  {
    $filenameComponentEpilog = $this->__path . self::FILENAME_EPILOG;

    if (file_exists($filenameComponentEpilog)) {
      include $filenameComponentEpilog;
    }
  }

  /**
   * подключает компонент шаблона на страницу
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
   * Подключает и копирует в публичное пространство
   * файлы скриптов и стилей
   *
   * @return void
   * @throws Exception Файл стиля и(или) скрипта компонета не перемещен
   */
  private function includeAssets()
  {
    $сomponentAssetsDir = ROOT_ASSETS . '/' . str_replace(':', '/', $this->component->componentId) . '/';

    if (!(is_dir($сomponentAssetsDir))) {
      mkdir($сomponentAssetsDir, 0777, true);
    }

    $this->includeJS($сomponentAssetsDir);
    $this->includeCSS($сomponentAssetsDir);
  }

  /**
   * Подключает и копирует в публичное пространство
   * файл скрипта
   * @param string $сomponentAssetsDir url директории для assets
   * @return void
   * @throws Exception Файл стрипта компонета не перемещен
   */
  private function includeJS(string $сomponentAssetsDir)
  {
    $filenameScript = $this->__path . self::FILENAME_SCRIPT;
    $scriptPathAsset = $сomponentAssetsDir . self::FILENAME_SCRIPT;

    if (file_exists($filenameScript)) {

      if (!file_exists($scriptPathAsset)) {
        if (!copy($filenameScript, $scriptPathAsset)) {
          throw new Exception("Файл стрипта компонета {$this->component->componentId} не перемещен");
        }
      }

      $this->page->addJs($this->__relativePath . "script.js");
    }
  }

  /**
   * Подключает и копирует в публичное пространство
   * файл стиля
   * @param string $сomponentAssetsDir url директории для assets
   * @return void
   * @throws Exception Файл стиля компонета не перемещен
   */
  private function includeCSS(string $сomponentAssetsDir)
  {
    $filenameStyle = $this->__path . self::FILENAME_STYLE;
    $stylePathAsset = $сomponentAssetsDir . self::FILENAME_STYLE;

    if (file_exists($filenameStyle)) {

      if (!file_exists($stylePathAsset)) {
        if (!copy($filenameStyle, $stylePathAsset)) {
          throw new Exception("Файл стиля компонента {$this->component->componentId} не перемещен");
        }
      }

      $this->page->addCss($this->__relativePath . "style.css");
    }
  }

}