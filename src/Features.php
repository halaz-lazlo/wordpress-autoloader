<?php

namespace HL\WPAutoloader;

class Features {

    private $options;

    public function init($options = null)
    {
        $this->options = [
            'language_textdomain' => 'wpa',
            'img_sizes' => [
                'md' => 600,
                'sm' => 300,
                'lg' => 1200,
            ],
            'hidden_menu_pages' => [
                'index.php',
                'edit.php',
                'upload.php',
                'edit.php?post_type=page',
                'edit-comments.php',
                'themes.php',
                'plugins.php',
                'users.php',
                'tools.php',
                'options-general.php'
            ],
            'available_menu_pages' => [
                'index.php',
                'edit.php',
                'upload.php',
                'edit.php?post_type=page',
                'edit-comments.php',
                'themes.php',
                'plugins.php',
                'users.php',
                'tools.php',
                'options-general.php'
            ],
            'hidden_screen_options' => [
                'page' => [
                    'title', // content title
                    'editor', // content editor
                    'authordiv', //– Author metabox
                    'categorydiv', //– Categories metabox.
                    'commentstatusdiv', //– Comments status metabox (discussion)
                    'commentsdiv', //– Comments metabox
                    'formatdiv', //– Formats metabox
                    'pageparentdiv', //– Attributes metabox
                    'postcustom', //– Custom fields metabox
                    'postexcerpt', //– Excerpt metabox
                    'postimagediv', //– Featured image metabox
                    'revisionsdiv', //– Revisions metabox
                    'slugdiv', //– Slug metabox
                    'submitdiv', //– Date, status, and update/save metabox

                    'author',
                    'thumbnail',
                    'excerpt',
                    'trackbacks',
                    'custom-fields',
                    'comments',
                    'revisions',
                    'page-attributes',
                    'post-formats'
                ]
            ]
        ];

        if ($options) {
            $this->options = array_merge($this->options, $options);
        }

        // i18n
        load_theme_textdomain(
            $this->options['language_textdomain'],
            BASE_PATH.'/src/Resources/translations'
        );

        // build admin menu
        add_action('admin_menu', [$this, 'build_admin_menu']);

        // allow menus
        add_theme_support('menus');

        // clear wp img sizes
        add_filter('intermediate_image_sizes_advanced', [$this, 'clear_img_sizes']);

        // add new sizes
        add_action('after_setup_theme', [$this, 'add_img_sizes']);

        // allow thumbs
        add_theme_support('post-thumbnails');

        // build metaboxes
        add_action('admin_menu', [$this, 'build_metaboxes']);
    }

    /**
     * build left main admin menu
     */
    public function build_admin_menu()
    {
        foreach ($this->options['hidden_menu_pages'] as $menuPage) {
            if (!in_array($menuPage, $this->options['available_menu_pages'])) {
                remove_menu_page($menuPage);
            }
        }
    }

    /**
     * clear img sizes
     */
    public function clear_img_sizes($sizes)
    {
        unset($sizes['thumbnail']);
        unset($sizes['medium']);
        unset($sizes['medium_large']);
        unset($sizes['large']);

        return $sizes;
    }

    /**
     * add predefined image sizes
     */
    public function add_img_sizes()
    {
        foreach ($this->options['img_sizes'] as $key => $imgSize) {
            add_image_size($key, $imgSize, '', true);
        }
    }

    public function build_metaboxes()
    {
        foreach ($this->options['hidden_screen_options'] as $postType => $screenOptions) {
            foreach ($screenOptions as $screenOption) {
                if (!in_array($screenOption, $this->options['screen_options'][$postType])) {
                    remove_meta_box($screenOption, $postType, 'normal');
                    remove_post_type_support($postType, $screenOption);
                }
            }
        }
    }
}
