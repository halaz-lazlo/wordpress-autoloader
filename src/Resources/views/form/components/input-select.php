<?php
    $select = [
        'choices' => isset($input['choices']) ? $input['choices'] : null,
        'is_select2' => isset($input['select2']) ? $input['select2'] : false,
        'has_squares' => isset($input['select2_squares']) ? $input['select2_squares'] : false,
        'multiple' => isset($input['multiple']) ? $input['multiple'] : false,
        'value' => isset($input['value']) ? $input['value'] : null,
    ];

    $selectedKey = array_search($select['value'], $select['choices']);

    if ($selectedKey) {
        $select['selected_key'] = $selectedKey;
    }
?>

<select
    name="<?php echo $input_id; ?>[]"
    id="<?php echo $input_id; ?>"
    class="form__input form__input--select <?php if ($select['is_select2']): ?>js-select2<?php endif ?>"
    data-property="category"
    <?php if ($select['has_squares']): ?>
        data-class="select2-container--square"
    <?php endif ?>
    <?php if ($select['multiple']): ?>
        multiple="multiple"
    <?php endif ?>>

    <!-- choices -->
    <?php if ($select['choices']): ?>
        <?php foreach ($select['choices'] as $choice_key => $choice_value): ?>
            <option value="<?php echo $choice_value; ?>" class="<?php echo sanitize_title($choice_value); ?>" <?php if (isset($select['selected_key']) && $select['selected_key'] == $choice_key): ?>selected<?php endif ?>>
                <?php echo $choice_value; ?>
            </option>
        <?php endforeach ?>
    <?php endif ?>
</select>
