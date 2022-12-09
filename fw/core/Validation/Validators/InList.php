<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;

class InList extends Validator
{

  public function validate($value): bool
  {
    return in_array($value, $this->rule);
  }
}