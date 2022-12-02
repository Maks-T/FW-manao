<?php

namespace FW\Core\Type;

class Server extends Dictionary
{
  public function __construct($values, bool $readonly = false)
  {
    parent::__construct($_SERVER, true);
  }
}