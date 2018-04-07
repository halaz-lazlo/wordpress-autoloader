<?php

namespace HL\WPAutoloader;

class Shortcodes
{
    protected $shortcodes;

    protected $vcShortcodes;

    protected $vcShortcodesDefault;

    public function __construct()
    {
        $this->vcShortcodesDefault = [
            // section
            [
                'name'                    => __('Section', 'wpa'),
                'base'                    => 'vc_row',
                'is_container'            => true,
                'icon'                    => 'icon-wpb-row',
                'show_settings_on_create' => false,
                'category'                => __('Layout', 'wpa'),
                'description'             => __('Wrapper for elements', 'wpa'),
                'params'                  => [
                    [
                        'type'       => 'dropdown',
                        'heading'    => __('Background', 'wpa'),
                        'param_name' => 'bg',
                        'value'      => [
                            __('None', 'wpa')  => '',
                            __('White', 'wpa') => 'white'
                        ],
                        'description' => __('The background of the section', 'wpa'),
                    ],
                    [
                        'type'        => 'checkbox',
                        'heading'     => __('Remove padding on top?', 'wpa'),
                        'param_name'  => 'rm_pt',
                        'description' => __('Is padded from top', 'wpa'),
                        'value'       => [
                            __('Yes', 'wpa') => '1'
                        ],
                    ],
                    [
                        'type'        => 'checkbox',
                        'heading'     => __('Remove padding on bottom?', 'wpa'),
                        'param_name'  => 'rm_pb',
                        'description' => __('Is padded from bottom', 'wpa'),
                        'value'       => [
                            __('Yes', 'wpa') => '1'
                        ],
                    ],
                ],
                'js_view' => 'VcRowView',
            ],

            // section inner
            [
                'name'            => __( 'Column', 'js_composer' ),
                'base'            => 'vc_column',
                'icon'            => 'icon-wpb-row',
                'is_container'    => true,
                'content_element' => false,
                'description'     => __( 'Place content elements inside the column', 'js_composer' ),
                'js_view'         => 'VcColumnView',
            ],

            // row
            [
                'name'                    => __('Row', 'wpa'), //Inner Row
                'base'                    => 'vc_row_inner',
                'content_element'         => false,
                'is_container'            => true,
                'icon'                    => 'icon-wpb-row',
                'weight'                  => 1000,
                'show_settings_on_create' => false,
                'description'             => __('Place content elements inside the inner row', 'wpa'),
                'js_view'                 => 'VcRowView',
                'params'                  => [
                    [
                        'type'        => 'checkbox',
                        'heading'     => __('Some padding on the top?', 'wpa'),
                        'param_name'  => 'padding_top',
                        'description' => __('Is padded from top with default.', 'wpa'),
                        'value'       => [
                            __('Yes, please', 'wpa') => 'yes'
                        ],
                    ],
                ],
            ],

            // column inner
            [
                'name'                      => __('Column', 'wpa'),
                'base'                      => 'vc_column_inner',
                'icon'                      => 'icon-wpb-row',
                'class'                     => '',
                'wrapper_class'             => '',
                'controls'                  => 'full',
                'allowed_container_element' => false,
                'content_element'           => false,
                'is_container'              => true,
                'description'               => __('Place content elements inside the inner column', 'wpa'),
                'params'                    => [
                    [
                        'heading'     => __('Align content', 'wpa'),
                        'group'       => __('Options', 'wpa'),
                        'param_name'  => 'align',
                        'type'        => 'dropdown',
                        'description' => __('The align of content if necessary', 'wpa'),
                        'value'       => [
                            __('None (left)', 'wpa') => 'left',
                            __('Center', 'wpa')      => 'center',
                            __('Right', 'wpa')       => 'right'
                        ]
                    ],
                    [
                        'type'        => 'dropdown',
                        'heading'     => __('Width', 'js_composer'),
                        'param_name'  => 'width',
                        'value'       => [
                            __('1 column - 1/12', 'wpa')    => '1/12',
                            __('2 columns - 1/6', 'wpa')    => '1/6',
                            __('3 columns - 1/4', 'wpa')    => '1/4',
                            __('4 columns - 1/3', 'wpa')    => '1/3',
                            __('5 columns - 5/12', 'wpa')   => '5/12',
                            __('6 columns - 1/2', 'wpa')    => '1/2',
                            __('7 columns - 7/12', 'wpa')   => '7/12',
                            __('8 columns - 2/3', 'wpa')    => '2/3',
                            __('9 columns - 3/4', 'wpa')    => '3/4',
                            __('10 columns - 5/6', 'wpa')   => '5/6',
                            __('11 columns - 11/12', 'wpa') => '11/12',
                            __('12 columns - 1/1', 'wpa')   => '1/1'
                        ],
                        'group'       => __('Responsive Options', 'js_composer'),
                        'description' => __('Select column width.', 'js_composer'),
                        'std'         => '1/1',
                    ],
                    [
                        'type'        => 'column_offset',
                        'heading'     => __('Responsiveness', 'js_composer'),
                        'param_name'  => 'offset',
                        'group'       => __( 'Responsive Options', 'js_composer'),
                        'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' ),
                    ],
                ],
                'js_view' => 'VcColumnView',
            ]
        ];
    }

    public function init()
    {
        add_action('vc_after_init', [$this, 'remove_vc_shortcodes']);
        add_action('vc_before_init', [$this, 'init_vc_shortcodes']);
        add_action('vc_before_init', [$this, 'load_shortcodes']);
    }

    public function load_shortcodes()
    {
        if (is_array($this->vcShortcodes)) {
            $this->vcShortcodes = array_merge($this->vcShortcodesDefault, $this->vcShortcodes);
        } else {
            $this->vcShortcodes = $this->vcShortcodesDefault;
        }

        // load vc shortcodes into shortcodes
        if (is_array($this->vcShortcodes) ) {
            foreach ($this->vcShortcodes as $vcShortcode) {
                $this->shortcodes[] = $vcShortcode['base'];

                if (function_exists('vc_map')) {
                    vc_map($vcShortcode);
                }
            }
        }

        // load default shortcodes
        if (is_array($this->shortcodes)) {
            foreach ($this->shortcodes as $shortcode) {
                add_shortcode($shortcode, function($atts, $content = '') use ($shortcode) {
                    global $app;
                    $atts = (is_array($atts)) ? $atts : [];
                    $template = str_replace('_', '-', $shortcode);

                    return $app->render('shortcodes/'.$template.'.php', [
                        'atts'    => $atts,
                        'content' => $content
                    ], true);
                });
            }
        }
    }

    public function remove_vc_shortcodes()
    {
        $elementsToRemove = ['vc_separator', 'vc_column_text', 'vc_icon', 'vc_text_separator', 'vc_message', 'vc_text_separator', 'vc_message', 'vc_facebook', 'vc_tweetmeme', 'vc_googleplus', 'vc_pinterest', 'vc_toggle', 'vc_single_image', 'vc_gallery', 'vc_images_carousel', 'vc_tta_tabs', 'vc_tta_tour', 'vc_tta_accordion', 'vc_tta_pageable', 'vc_tta_section', 'vc_tabs', 'vc_tour', 'vc_accordion', 'vc_posts_slider', 'vc_widget_sidebar', 'vc_button', 'vc_button2', 'vc_cta_button', 'vc_cta_button2', 'vc_video', 'vc_gmaps', 'vc_raw_html', 'vc_raw_js', 'vc_flickr', 'vc_progress_bar', 'vc_pie', 'vc_round_chart', 'vc_line_chart', 'vc_empty_space', 'vc_custom_heading', 'vc_btn', 'vc_cta', 'vc_basic_grid', 'vc_media_grid', 'vc_masonry_grid', 'vc_masonry_media_grid', 'vc_wp_search', 'vc_wp_meta', 'vc_wp_recentcomments', 'vc_wp_calendar', 'vc_wp_pages', 'vc_wp_tagcloud', 'vc_wp_custommenu', 'vc_wp_text', 'vc_wp_posts', 'vc_wp_categories', 'vc_wp_archives', 'vc_wp_rss'
        ];

        foreach ($elementsToRemove as $element) {
            vc_remove_element($element);
        }
    }

    public function init_vc_shortcodes()
    {}
}
