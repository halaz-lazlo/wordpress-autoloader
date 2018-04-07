<div class="form__choices <?php if (isset($input['hide_inputs'])): ?>form__group--hide-inputs<?php endif ?>">
    <?php foreach ($input['choices'] as $choice_key => $choice_value): ?>
        <?php
            $checked = ($choice_key == $input['value']) ? 'checked' : '';
        ?>

        <label for="<?php echo $choice_key; ?>" class="form__choice">
            <input type="radio" id="<?php echo $choice_key; ?>" name="<?php echo $input_id; ?>" value="<?php echo $choice_key; ?>" class="form__input form__input--radio" <?php echo $checked; ?>> <?php echo $choice_value; ?>
        </label>
    <?php endforeach ?>
</div>
