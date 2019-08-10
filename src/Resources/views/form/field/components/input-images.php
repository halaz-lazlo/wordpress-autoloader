<div class="input-imgs">
    <input
        id="<?php echo $field->getId(); ?>"
        class="input-imgs__val hidden"
        name="<?php echo $field->getId(); ?>"
        value="<?php echo $field->getValue(); ?>" />


    <div id="input-imgs__thumbs" class="input-imgs__thumbs">
        <?php if($field->getValue()) :  ?>
            <?php foreach(explode(',', $field->getValue()) as $imgId) : ?>
                <div data-id="<?php echo $imgId; ?>" class="input-imgs__thumb">
                    <img
                        class="input-imgs__thumb-img"
                        src="<?php echo wp_get_attachment_image_src($imgId, 'sm')[0]; ?>">
                    <div class="input-imgs__thumb-remove">X</div>
                </div>
            <?php endforeach; ?>
        <?php endif;  ?>
    </div>

    <div class="input-imgs__footer">
        <button class="input-imgs__btn button">
            <?php echo __('Add', get_template()); ?>
        </button>
    </div>
</div>
