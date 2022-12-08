<?php
/** @var  Template $this */
/** @var  InterfaceSelect $cmnt */

declare(strict_types=1);

use \FW\Components\FW\InterfaceSelect;
use FW\Core\Component\Template;

$cmnt = $this->component;
?>

<fieldset class="mb-3<?= $cmnt->class ?>">
    <legend class="d-block text-primary text-capitalize"><?= $cmnt->title ?></legend>
    <select class="form-select d-block px-2 py-1 border border-primary form-control"
           type="<?= $cmnt->type ?>"
           name="<?= $cmnt->name ?>"
           <?= $cmnt->getAttr(); ?> >
        <?php
            foreach ($cmnt->params['options'] as $key => $value) {
                $selected = $cmnt->selected == $key ? ' selected' : '';
              echo "<option value=\"$key\" $selected>$value</option>";
            }
        ?>
    </select>
</fieldset>
