<div class="input-imgs">
    <input
        id="<?php echo $input_id; ?>"
        class="input-imgs__val hidden"
        name="<?php echo $input_id; ?>"
        value="<?php echo $input['value']; ?>" />


    <div class="input-imgs__thumbs">
        <?php if($input['value']) :  ?>
            <?php foreach(explode(',', $input['value']) as $imgId) : ?>
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
            Add
        </button>
    </div>
</div>
