<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;


class Phone extends RegExp
{

  public function __construct($rule = null)
  {
    parent::__construct($rule);
    $this->rule = '/^\+?([0-9]{1,3})-?([0-9]{2})-?([0-9]{7})$/';
  }

}