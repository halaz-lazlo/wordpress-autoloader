<?php

namespace HL\WPAutoloader;

class Filters
{
    public function init()
    {
        remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
        remove_filter('the_content', 'wpautop');

        // autop
        add_filter('the_content', [$this, 'autop']);
        add_filter('the_excerpt', [$this, 'autop']);

        // price
        add_filter('price', [$this, 'price']);

        // minify final html
        add_action('wp_loaded', [$this, 'minify_html']);

        // set email type
        add_filter('wp_mail_content_type', [$this, 'email_type']);
    }

    /**
     * minify html call
     */
    public function minify_html()
    {
        ob_start([$this, 'compress_html']);
    }

    /**
     * script to minify html
     * @param  string $html the non minified htlm
     * @return string       the minified html
     */
    public function compress_html($html)
    {
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1'
        );

        if (!WP_DEBUG && !is_admin()) {
            $html = preg_replace($search, $replace, $html);
        }

        return $html;
    }

    /**
     * add txt class to p elements when the_content()
     */
    public function autop($content)
    {
        $content = str_replace('<p>', '<p class="txt txt--std">', $content);
        $content = str_replace('<ol>', '<ol class="list list--ordered">', $content);
        $content = str_replace('<ul>', '<ul class="list list--std">', $content);
        $content = str_replace('<li>', '<li class="list__item">', $content);
        $content = str_replace('<a', '<a class="link link--std"', $content);

        return $content;
    }

    /**
     * price filter
     * @param  int $price
     * @param  string $currency
     * @return string
     */
    public function price($price)
    {
        return number_format($price, 0, '', ' ');
    }

    /**
     * set the type of emails
     * @return string
     */
    public function email_type()
    {
        return "text/html";
    }
}
