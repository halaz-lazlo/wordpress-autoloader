<input
    id="<?php echo $field->getId(); ?>"
    type="<?php echo $field->getType() ?>"
    name="<?php echo $field->getId(); ?>"
    class="form__input form__input--<?php echo $field->getType(); ?>"

    <?php if ($field->getValue()): ?>
        value="<?php echo $field->getValue(); ?>"
    <?php endif ?>

    <?php if ($field->getPlaceholder()) : ?>
        placeholder="<?php echo $field->getPlaceholder(); ?>"
    <?php endif ?>
>
