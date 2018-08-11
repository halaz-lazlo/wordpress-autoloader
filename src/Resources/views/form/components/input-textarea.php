<textarea
    name="<?php echo $input_id; ?>"
    id="<?php echo $input_id; ?>"
    class="form__input form__input--textarea"
    <?php if (isset($input['placeholder'])): ?>
        placeholder="<?php echo $input['placeholder']; ?>"
    <?php endif ?>><?php echo $input['value']; ?></textarea>
