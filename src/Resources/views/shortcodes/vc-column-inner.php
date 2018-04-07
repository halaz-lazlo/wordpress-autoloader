<?php

$columnWidths = array(
    '1/12'  => 'col-sm-1',
    '1/6'   => 'col-sm-2',
    '1/4'   => 'col-sm-3',
    '1/3'   => 'col-sm-4',
    '5/12'  => 'col-sm-5',
    '1/2'   => 'col-sm-6',
    '7/12'  => 'col-sm-7',
    '2/3'   => 'col-sm-8',
    '3/4'   => 'col-sm-9',
    '5/6'   => 'col-sm-10',
    '11/12' => 'col-sm-11',
    '1/1'   => 'col-sm-12',
);

$classes = [];

// width
if (isset($atts['width'])) {
    $classes[] = $columnWidths[$atts['width']];
}

// offset
if (isset($atts['offset'])) {
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
}

if (!isset($atts['width']) && !isset($atts['offset'])) {
    $classes[] = 'col-lg-12';
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
