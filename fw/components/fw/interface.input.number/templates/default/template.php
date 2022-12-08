<?php
/** @var  Template $this */
/** @var  InterfaceInputNumber $cmnt */

declare(strict_types=1);

use \FW\Components\FW\InterfaceInputNumber;
use FW\Core\Component\Template;

$cmnt = $this->component;
?>

<fieldset class="<?= $cmnt->class ?>">
    <label class="d-block text-primary text-capitalize"><?= $cmnt->title ?></label>
    <input class="d-block px-2 py-1 border border-primary form-control"
           type="<?= $cmnt->type ?>"
           name="<?= $cmnt->name ?>"
           placeholder="<?= $cmnt->default ?>"
           <?= $cmnt->getAttr(); ?> >
</fieldset>
