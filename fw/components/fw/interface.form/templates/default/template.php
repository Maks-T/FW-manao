<?php
/** @var  Template $this */
/** @var  InterfaceForm $cmnt */

declare(strict_types=1);

use FW\Components\FW\InterfaceForm;
use FW\Core\App;
use FW\Core\Component\Template;
use FW\Core\InstanceContainer;

$cmnt = $this->component;
$app = InstanceContainer::get(App::class);

?>
<div class="row justify-content-center">
    <div class="col-12 col-xl-5 col-md-8">
        <form class="mb-3 p-2 border border-primary rounded px-4 py-2 <?= $cmnt->class ?>"
              action="<?= $cmnt->action ?>"
              method="<?= $cmnt->method ?>"
          <?= $cmnt->getAttr(); ?>
        >
            <div class="row">
                <legend class="fs-3 fw-bold text-center "><?= $cmnt->title ?></legend>
            </div>
            <div class="row">
              <?php
              foreach ($cmnt->params['elements'] as $element) {
                $app->includeComponent($element['component_name'], 'default', $element);
              }
              ?>
            </div>
        </form>

    </div>
</div>
