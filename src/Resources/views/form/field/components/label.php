<?php if ($field->getLabel()): ?>
    <label class="form__label" for="<?php echo $field->getId() ?>">
        <?php echo $field->getLabel(); ?>
    </label>
<?php endif ?>
