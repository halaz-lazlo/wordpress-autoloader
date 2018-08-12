

<div class="input-img <?php echo $input['value'] ? 'input-img--has-image': ''; ?>">
    <input
        id="<?php echo $input_id; ?>"
        class="input-img__val"
        type="hidden"
        name="<?php echo $input_id; ?>"
        value="<?php echo $input['value']; ?>" />

    <div class="input-img__thumb">
        <?php if($input['value']) :  ?>
            <img
                class="input-img__thumb-img"
                src="<?php echo wp_get_attachment_image_src($input['value'], 'lg')[0] ?>">
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
