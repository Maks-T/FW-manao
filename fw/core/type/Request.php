<?php

declare(strict_types=1);

namespace FW\Core\Type;

class Request extends Dictionary
{
  public function __construct()
  {
    parent::__construct($_REQUEST, true);
  }
}