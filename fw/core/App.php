<?php

declare(strict_types=1);

namespace FW\Core;

use FW\Core\Component\Base;
use FW\Core\Type\Request;
use FW\Core\Type\Server;
use FW\Core\Type\Session;

class App
{
  const TEMPLATE_ID = 'template/id';
  const FILE_HEADER = '/header.php';
  const FILE_FOOTER = '/footer.php';
  const COMPONENT_NAMESPACE = '\FW\Components\\';
  const COMPONENT_FILENAME_CLASS = '/Class.php';

  /**
   * @var bool $isBufferStart
   */
  private bool $isBufferStart = false;

  /**
   * @var Page|null $pager экземляр страницы
   */
  private ?Page $pager;

  /**
   * @var Request|null $request
   */
  private ?Request $request;

  /**
   * @var Server|null $server
   */
  private ?Server $server;

  /**
   * @var Session|null $session
   */
  private ?Session $session;

  /**
   * @var array $components массив имен классов компонентов
   */
  private array $components;

  public function __construct()
  {
    $this->pager = InstanceContainer::get(Page::class);
    $this->request = InstanceContainer::get(Request::class);
    $this->server = InstanceContainer::get(Server::class);
    $this->session = InstanceContainer::get(Session::class);
  }

  /**
   * подключает Header
   * @return void
   */
  public function header(): void
  {
    $this->startBuffer();
    include ROOT_TEMLATES . Config::get(self::TEMPLATE_ID) . self::FILE_HEADER;
  }

  /**
   * подключает Footer
   * @return void
   */
  public function footer()
  {
    include ROOT_TEMLATES . Config::get(self::TEMPLATE_ID) . self::FILE_FOOTER;
    $content = $this->endBuffer();

    echo $content;
  }

  /**
   * Старт буффера
   * @return void
   */
  private function startBuffer(): void
  {
    ob_start();
    $this->isBufferStart = true;
  }


  /**
   * Конец буфера
   * возвращает контент со всеми заменами
   * @return string
   */
  private function endBuffer(): string
  {
    $content = ob_get_clean();
    $this->isBufferStart = false;
    $replaces = $this->pager->getAllReplace();
    $content = str_replace(array_keys($replaces), $replaces, $content);

    return $content;
  }

  /**
   * Перезагрузкка буффера
   * @return void
   */
  public function restartBuffer(): void
  {
    if ($this->isBufferStart === true) {
      ob_clean();
    } else {
      $this->startBuffer();
    }
  }

  /**
   * возвращает экземляр страницы
   * @return Page
   */
  public function getPage(): Page
  {
    return $this->pager;
  }

  /**
   * возвращает экземляр Request
   * @return Request
   */
  public function getRequest(): Request
  {
    return $this->request;
  }

  /**
   * возвращает экземляр Server
   * @return Server
   */
  public function getServer(): Server
  {
    return $this->server;
  }

  /**
   * возвращает экземляр Session
   * @return Session
   */
  public function getSession(): Session
  {
    return $this->session;
  }

  /**
   * Подключает компонент на страницу
   * @param string $componentId id компонента типа 'fw:element.list'
   * @param string $templateId id components типа "default'
   * @param array $params параметры компонета
   * @return void
   */
  public function includeComponent(string $componentId, string $templateId, array $params)
  {
    try {
      $componentDir = ROOT_COMPONENTS .
        str_replace(':', '/', $componentId);

      if (!empty($this->components[$componentId])) {
        $classFullName = $this->components[$componentId];

      } else {

        $componentPath = $componentDir . self::COMPONENT_FILENAME_CLASS;

        if (!file_exists($componentPath)) {
          throw new \Exception("Компонент $componentId не существует");
        }

        include_once $componentPath;

        [$namespace, $className] = explode(':', $componentId);


        $classFullName = self::COMPONENT_NAMESPACE . $namespace . '\\' . classNameToCamelCase($className);

        if (!class_exists($classFullName)) {
          throw new \Exception("Класс $className не существует");
        }
        $this->components[$componentId] = $classFullName;
      }

      /**
       * @var Base $instanceComponent
       */
      $instanceComponent = new $classFullName($componentId, $templateId, $params, $componentDir);
      $instanceComponent->executeComponent();

    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

}