<?php
    use HL\WPAutoloader\Util\View;
?>

<?php if ($field->getType() != 'hidden'): ?>
    <div class="form__group">
        <?php $field->renderLabel(); ?>
        <?php $field->renderInput(); ?>
    </div>
<?php else: ?>
<?php endif ?>
