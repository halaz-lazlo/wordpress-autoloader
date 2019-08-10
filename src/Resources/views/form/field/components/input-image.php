<div class="input-img <?php echo $field->getValue() ? 'input-img--has-image': ''; ?>">
    <input
        id="<?php echo $field->getId(); ?>"
        class="input-img__val"
        type="hidden"
        name="<?php echo $field->getId(); ?>"
        value="<?php echo $field->getValue(); ?>" />

    <div class="input-img__thumb">
        <?php if($field->getValue()) :  ?>
            <img
                class="input-img__thumb-img"
                src="<?php echo wp_get_attachment_image_src($field->getValue(), 'lg')[0] ?>">
        <?php endif;  ?>
    </div>

    <div class="input-img__buttons">
        <button type="button" class="button input-img__button input-img__button--set">
            Set
        </button>

        <button type="button" class="button input-img__button input-img__button--change">
            Change
        </button>

        <button
            type="button"
            class="button input-img__button--remove">
            Remove
        </button>
    </div>
</div>
