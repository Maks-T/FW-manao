<?php

declare(strict_types=1);

namespace FW\Core\Type;

class Request extends Dictionary
{
  public function __construct($values, bool $readonly = false)
  {
    parent::__construct($_REQUEST, true);
  }
}