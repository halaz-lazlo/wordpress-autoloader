<?php
    $values = [];

    if (isset($input['value'])) {
        $values = explode('#', $input['value']);
    }
?>

<div id="<?php echo $input_id; ?>" class="form__choices <?php if (isset($input['hide_inputs'])): ?>form__group--hide-inputs<?php endif ?>">
    <?php foreach ($input['choices'] as $choice_key => $choice_value): ?>
        <?php
            $checked   = (in_array($choice_key, $values)) ? 'checked' : '';
            $choice_id = $input_id.'_'.$choice_key;
        ?>

        <label for="<?php echo $choice_id; ?>" class="form__input form__input--checkbox">
            <input
                type="checkbox"
                id="<?php echo $choice_id; ?>"
                name="<?php echo $input_id; ?>[]"
                value="<?php echo $choice_key; ?>"
                class="form__input-input"
                <?php echo $checked; ?>>
            <span class="form__input-label">
                <?php echo $choice_value; ?>
            </span>
        </label>
    <?php endforeach ?>
</div>
