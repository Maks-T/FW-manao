<?php

/** @var  Template $this */

declare(strict_types=1);

use FW\Core\Component\Template;

$params = &$this->component->params;

if (array_key_exists('additional_class', $params)) {
  $params['class'] = $params['additional_class'];
}

$mapComponent = [
  'text' => 'inteface.input.text',
  'text_multiple' => 'inteface.input.text.multiple',
  'number' => 'inteface.input.number',
  'password' => 'inteface.input.password',
  'checkbox' => 'inteface.input.checkbox',
  'checkbox_multiple' => 'inteface.input.checkbox.multiple',
  'input.radio' => 'inteface.input.radio',
  'select' => 'inteface.select',
  'select_multiple' => 'inteface.select.multiple',
  'textarea' => 'inteface.textarea'
];

if (array_key_exists('elements', $params)) {
  foreach ($params['elements'] as &$element) {

    if (
      array_key_exists('type', $element) &&
      array_key_exists($element['type'], $mapComponent)
    ) {
      $element['component_name'] = $mapComponent[$element['type']];
    }
  }
}

