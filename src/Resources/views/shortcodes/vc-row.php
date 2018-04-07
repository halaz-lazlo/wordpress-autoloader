<?php
    $section = [
        'bg'      => (isset($atts['bg'])) ? $atts['bg'] : null,
        'rm_pt'      => (isset($atts['rm_pt'])) ? ($atts['rm_pt'] === '1') : false,
        'rm_pb'      => (isset($atts['rm_pb'])) ? ($atts['rm_pb'] === '1') : false,
        'content' => wpb_js_remove_wpautop($content),
    ];

    $classes = ['page__section'];

    if ($section['bg']) {
        $classes[] = 'page__section--bg-'.$section['bg'];
    }

    if ($section['rm_pt']) {
        $classes[] = 'page__section--rm-pt';
    }

    if ($section['rm_pb']) {
        $classes[] = 'page__section--rm-pb';
    }
?>

<section class="<?php echo implode(' ', $classes); ?>">
    <?php echo $section['content']; ?>
</section>
