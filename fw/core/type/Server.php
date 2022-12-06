<?php

namespace FW\Core\Type;

class Server extends Dictionary
{
  public function __construct()
  {
    parent::__construct($_SERVER, true);
  }
}