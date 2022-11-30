<?php

declare(strict_types=1);

namespace FW\Core;

use FW\Core\Config;
use FW\Core\Page;

class App extends Multiton
{
  const TEMPLATE_ID = 'template/id';
  const FILE_HEADER = '/header.php';
  const FILE_FOOTER = '/footer.php';

  private $isBufferStart = false;

  private $page = null;

  private static $instance = null;

  private $template = null;

  protected function __construct()
  {
    $this->page = Page::getInstance();   
  }

  public function renderHeader()
  {   
    $this->startBuffer();
    include ROOT_TEMLATES . Config::get(self::TEMPLATE_ID) . self::FILE_HEADER;    
  }

  
  public function renderfooter()
  {
    include ROOT_TEMLATES  . Config::get(self::TEMPLATE_ID) . self::FILE_FOOTER;
    $content = $this->endBuffer();  

    echo $content;
  }

  private function startBuffer()
  {
    ob_start();
    $this->isBufferStart = true;
  }


  private function endBuffer()
  {
    $content = ob_get_clean();
    $this->isBufferStart = false;    
    $replaces = $this->page->getAllReplace();   
    $content = str_replace(array_keys($replaces), $replaces, $content);

    return $content;
  }

  public function restartBuffer()
  {
    if ($this->isBufferStart === true) {
      ob_clean();
    } else {
      $this->startBuffer();
      }
  }
}