<?php

declare(strict_types=1);

namespace FW\Components\FW;

use FW\Core\Component\Base;

class InterfaceForm extends Base
{

 public function __get($name)
 {
   return $this->params[strtolower($name)] ?? '';
 }

 public function getAttr(): string
 {
   $strAttr = '';

   if (array_key_exists('attr', $this->params)) {
     foreach($this->params['attr'] as $attr => $value)
     {
       $strAttr .= " $attr=\"$value\"";
     }
   }

   return $strAttr;
 }

  /**
   * Запускает компонент
   * @return void
   */
  public function executeComponent()
  {
    $this->template->render();
  }
}