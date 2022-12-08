<?php
/** @var  Template $this */
/** @var  InterfaceForm $cmnt */

declare(strict_types=1);

use FW\Core\Component\Template;
use FW\Components\FW\InterfaceForm;
use FW\Core\InstanceContainer;
use FW\Core\App;

$cmnt = $this->component;
$app = InstanceContainer::get(App::class);

?>

<form class="mb-3 p-2 border border-primary rounded <?= $cmnt->class ?>"
      action="<?= $cmnt->action ?>"
      method="<?= $cmnt->method ?>"
  <?= $cmnt->getAttr(); ?>
>
    <div class="row">
        <p class="fs-3 fw-bold text-center "><?= $cmnt->title ?></p>
    </div>
    <div class="row">
      <?php
      foreach ($cmnt->params['elements'] as $element) {
        $app->includeComponent($element['component_name'], 'default', $element);
      }
      ?>
    </div>

</form>
