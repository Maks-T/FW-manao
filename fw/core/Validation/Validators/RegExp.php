<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;

class RegExp extends Validator
{

  public function validate($value): bool
  {
    return (bool) preg_match($this->rule, $value);
  }
}