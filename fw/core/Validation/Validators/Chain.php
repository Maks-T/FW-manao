<?php

declare(strict_types=1);

namespace FW\Core\Validation\Validators;

use FW\Core\Validation\Validator;

class Chain extends Validator
{

  public function validate(mixed $value): bool
  {
    $result = false;

    foreach ($this->rule as $validator) {
      if (!($validator instanceof Validator)) {
        continue;
      }
      if (!$result = $validator->validate($value)) {
        break;
      }

    }
    return $result;
  }
}