<?php

namespace FW\Core\Type;

class Session extends Dictionary
{
  public function __construct($values, bool $readonly = false)
  {
    parent::__construct($_SESSION);
  }
}