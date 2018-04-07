<?php
    $today = new \DateTime();
    $thisWeek = new \DateTime();
    $thisMonth = new \DateTime();

    $thisWeek->modify('this week +7 days');
    $thisMonth->modify('last day of this month');

    $date = [
        'dates' => [
            [
                'label' => __('Today', 'wpa'),
                'value' => $today->format('Y-m-d 23:59')
            ],
            [
                'label' => __('This week', 'wpa'),
                'value' => $thisWeek->format('Y-m-d 23:59')
            ],
            [
                'label' => __('This month', 'wpa'),
                'value' => $thisMonth->format('Y-m-d 23:59')
            ]
        ]
    ];
?>

<div class="form__input--date">
    <?php foreach ($date['dates'] as $item): ?>
        <?php
            $itemId = $input_id.'_'.sanitize_title($item['label']);
        ?>

        <input id="<?php echo $itemId; ?>" type="radio" name="<?php echo $input_id; ?>" value="<?php echo $item['value'];  ?>" class="form__input-input">
        <label for="<?php echo $itemId; ?>" class="form__input-btn">
            <span class="form__input-label">
                <?php echo $item['label']; ?>
            </span>
        </label>
    <?php endforeach ?>

    <input type="hidden" class="form__input--daterange js-drp">
    <div class="form__input-btn form__input-btn--thin js-drp-open-btn">
        <span class="form__input-label">
            <svg viewBox="0 0 100 100" class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-calendar"></use>
            </svg>
        </span>
    </div>
</div>
