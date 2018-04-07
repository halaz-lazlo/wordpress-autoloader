<input
    id="<?php echo $input_id; ?>"
    type="text"
    name="<?php echo $input_id; ?>"
    class="form__input form__input--text"

    <?php if (isset($input['value'])): ?>
        value="<?php echo $input['value']; ?>"
    <?php endif ?>

    <?php if (isset($input['placeholder'])): ?>
        placeholder="<?php echo $input['placeholder']; ?>"
    <?php endif ?>
>
