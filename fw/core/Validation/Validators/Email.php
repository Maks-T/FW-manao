<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;

class Email extends RegExp
{

  public function __construct($rule = null)
  {
    parent::__construct($rule);
    $this->rule = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
  }

}