<?php
/** @var  Template $this */
/** @var  InterfaceInputCheckboxmultiple $cmnt */

declare(strict_types=1);

use \FW\Components\FW\InterfaceInputCheckboxmultiple;
use FW\Core\Component\Template;
use FW\Core\InstanceContainer;
use FW\Core\App;

$cmnt = $this->component;
$app = InstanceContainer::get(App::class);

?>

<div class="col-12">
    <fieldset
            class="checkbox-mulltiple m-3 p-2 border-primary rounded px-4 py-3  <?= $cmnt->class ?> "
            action="<?= $cmnt->action ?>"
            method="<?= $cmnt->method ?>"
      <?= $cmnt->getAttr(); ?>
    >
        <div class="row">
            <legend class="fs-5 fw-bold text-center "><?= $cmnt->title ?></legend>
        </div>
        <div class="row">
          <?php
          foreach ($cmnt->params['elements'] as $element) {
            $app->includeComponent($element['component_name'], 'default', $element);
          }
          ?>
        </div>
    </fieldset>
</div>
