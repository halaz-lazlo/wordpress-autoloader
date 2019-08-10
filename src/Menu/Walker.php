<?php

namespace HL\WPAutoloader\Menu;

class Walker extends \Walker {

    public $tree_type = 'page';
    private $baseUrl;

    public function __construct($baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
    }

    public $db_fields = [
        'parent' => 'menu_item_parent',
        'id' => 'db_id'
    ];

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "<ul class='menu__submenu'>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "</ul>\n";
    }

    public function start_el( &$output, $element, $depth = 0, $args = array(), $current_object_id = 0 )
    {
        $liClass = 'menu__item';
        $liClasses = [$liClass];

        $linkClass = isset($args->link_class) ? $args->link_class : null;
        $linkClasses = ['menu__link', $linkClass];

        if ($element->current) {
            $linkClasses[] = 'menu__link--active';
        }

        if ($this->baseUrl && is_front_page()) {
            $linkClasses[] = 'js-scroll-to';
        }

        if (in_array('menu-item-has-children', $element->classes)) {
            $liClasses[] = $liClass.'--parent';
        }

        if (in_array('menu__item--btn', $element->classes)) {
            $linkClasses[] = 'menu__item--btn';
        }

        if (in_array("current_page_item", $element->classes)) {
            $liClasses[] = 'menu__item--active';
        }

        $url = $element->url;

        $output .= '<li class="'.implode(' ', $liClasses).'"><a href="'.$url.'" class="'.implode(' ', $linkClasses).'">'.$element->title.'</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>";
    }
}
