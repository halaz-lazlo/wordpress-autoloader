<?php
    $row = [
        'padding_top' => isset($atts['padding_top']) ? $atts['padding_top'] : null,
    ];
?>
<div class="container">
    <div class="row<?php if ($row['padding_top']): ?> page__row page__row--padding-top<?php endif ?>">
        <?php echo wpb_js_remove_wpautop($content); ?>
    </div>
</div>
