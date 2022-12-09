<?php

declare(strict_types=1);

namespace FW\Core\Validation;

/**
 * Создадим абстрактный класс, для фабричности наших валидаторов
 * И обязуем наследников переопределять метод valid
 */
abstract class Validator
{
  protected $rule = null; // правило для валидации

  public function __construct($rule = null)
  {
    $this->rule = $rule;
  }

  abstract public function validate($value): bool;
}
