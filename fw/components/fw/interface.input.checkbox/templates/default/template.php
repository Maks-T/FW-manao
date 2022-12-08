<?php
/** @var  Template $this */
/** @var  InterfaceInputCheckbox $cmnt */

declare(strict_types=1);

use \FW\Components\FW\InterfaceInputCheckbox;
use FW\Core\Component\Template;

$cmnt = $this->component;
?>

<fieldset class="<?= $cmnt->class ?>">
    <input class="form-check-input"
           name="<?= $cmnt->name ?>"
           type="<?= $cmnt->type ?>"
           value="<?= $cmnt->value ?>"
           id="<?= $cmnt->id ?>"
      <?= isset($cmnt->params['checked']) ? "checked=\"$cmnt->checked\"" : '' ?>
      <?= $cmnt->getAttr(); ?> >
    <label class="form-check-label"
           for="<?= $cmnt->id ?>">
      <?= $cmnt->title ?>
    </label>
</fieldset>
