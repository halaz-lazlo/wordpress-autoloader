<?php

$classes = [];
$classesArr = explode(' ', $atts['offset']);

foreach ($classesArr as $class) {
    $convertedClass = str_replace('vc_', '', $class);

    if (strpos($convertedClass, 'offset') !== false) {
        $convertedClass = str_replace('col-', '', $convertedClass);
        $convertedClass = str_replace('offset-', '', $convertedClass);

        $convertedClass = 'offset-'.$convertedClass;
    }

    $classes[] = $convertedClass;
}

$col = [
    'content' => wpb_js_remove_wpautop($content),
    'align' => (isset($atts['align'])) ? $atts['align'] : null
];

if ($col['align']) {
    $classes[] = 'page__col--txt-'.$col['align'];
}

?>

<div class="page__col <?php echo implode(' ', $classes); ?>">
    <?php echo $col['content']; ?>
</div>
