<textarea
    name="<?php echo $field->getId(); ?>"
    id="<?php echo $field->getId(); ?>"
    class="form__input form__input--textarea"
    <?php if ($field->getPlaceholder()) : ?>
        placeholder="<?php echo $field->getPlaceholder(); ?>"
    <?php endif ?>><?php if($field->getValue()) {
        echo $field->getValue();
    } ?></textarea>
