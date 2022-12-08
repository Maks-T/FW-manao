<?php
/** @var  Template $this */
/** @var  InterfaceSelectMultiple $cmnt */

declare(strict_types=1);

use \FW\Components\FW\InterfaceSelectMultiple;
use FW\Core\Component\Template;

$cmnt = $this->component;
?>

<fieldset class="mb-3 form-select <?= $cmnt->class ?>">
    <legend class="d-block text-primary text-capitalize"><?= $cmnt->title ?></legend>
    <select class="d-block px-2 py-1 border border-primary form-control"
           multiple
           type="select"
           name="<?= $cmnt->name ?>"
           <?= $cmnt->getAttr(); ?> >
        <?php
            foreach ($cmnt->params['options'] as $key => $value) {
                $selected = in_array($key, $cmnt->selected)  ? 'selected' : '';
              echo "<option value=\"$key\" $selected>$value</option>";
            }
        ?>
    </select>
</fieldset>
