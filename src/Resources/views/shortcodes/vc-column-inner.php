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

    $col = [
        'width'   => (isset($atts['width'])) ? $columnWidths[$atts['width']] : 'col-sm-12',
        'offset'  => (isset($atts['offset'])) ? str_replace('vc_', '', $atts['offset']) : null,
        'content' => wpb_js_remove_wpautop($content),
        'align' => (isset($atts['align'])) ? $atts['align'] : null
    ];

    $classes = [$col['width']];
    if ($col['offset']) {
        $classes[] = $col['offset'];
    }
    if ($col['align']) {
        $classes[] = 'page__col--txt-'.$col['align'];
    }
 ?>

 <div class="page__col <?php echo implode(' ', $classes); ?>">
    <?php echo $col['content']; ?>
 </div>
