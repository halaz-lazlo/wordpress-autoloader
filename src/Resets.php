<?php

namespace HL\WPAutoloader;

class Resets {

    function init()
    {
        // remove admin bar
        add_filter('show_admin_bar', '__return_false');

        // remove svg
        add_filter('emoji_svg_url', '__return_false');

        // remove bullshit js
        add_action('wp_footer', [$this, 'deregister_scrips']);

        // Remove Actions
        remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
        remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
        remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
        remove_action('wp_head', 'index_rel_link'); // Index link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
        remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);
        remove_action('wp_head', 'rest_output_link_wp_head');

        // rm wp emoji
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script' );
        remove_action('admin_print_styles', 'print_emoji_styles' );

        // dont add body_class
        remove_action('init', 'body_class');
    }

    /**
     * deregister bullshit scripts
     */
    public function deregister_scrips()
    {
        wp_deregister_script('wp-embed');
    }
}
