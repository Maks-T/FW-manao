<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;

class Number extends Validator
{
  public function validate($value): bool
  {
    return is_numeric($value);
  }
}