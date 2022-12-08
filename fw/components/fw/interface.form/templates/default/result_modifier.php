<?php

/** @var  Template $this */

declare(strict_types=1);

use FW\Core\Component\Template;

$params = &$this->component->params;

$mapComponent = [
  'text' => 'fw:interface.input.text',
  'input_multiple' => 'fw:interface.input.multiple',
  'number' => 'fw:interface.input.number',
  'password' => 'fw:interface.input.password',
  'checkbox' => 'fw:interface.input.checkbox',
  'checkbox_multiple' => 'fw:interface.input.checkbox.multiple',
  'radio' => 'fw:interface.input.radio',
  'select' => 'fw:interface.select',
  'select_multiple' => 'fw:interface.select.multiple',
  'textarea' => 'fw:interface.textarea'
];

/**
 * @param $params входящие параметры компонета для изменения
 * @param $mapComponent карта привязки наименований компонентов к типу элемента
 * @return void
 */
function modificateParams(&$params, $mapComponent): void
{
  if (array_key_exists('additional_class', $params)) {
    $params['class'] = $params['additional_class'];
  }

  if (array_key_exists('elements', $params)) {
    foreach ($params['elements'] as &$element) {
      if (
        array_key_exists('type', $element) &&
        array_key_exists($element['type'], $mapComponent)
      ) {
        $element['component_name'] = $mapComponent[$element['type']];
      }

      modificateParams($element, $mapComponent);
    }
  }
}

modificateParams($params, $mapComponent);
