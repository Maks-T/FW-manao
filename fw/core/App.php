<?php

declare(strict_types=1);

namespace FW\Core;

use FW\Core\Config;

class App extends Multiton
{
  private $pager = null;

  private static $instance = null;

  private $template = null;

  public function addPage(string $page)
  {
    $this->pager = $page;
  }
}
