<?php

namespace HL\WPAutoloader;

class Settings
{
    public function init()
    {
        // site
        define('SITE_URI', get_site_url());

        // base
        define('BASE_PATH', get_stylesheet_directory());
        define('BASE_URI', get_stylesheet_directory_uri());

        // templates
        define('TEMPLATE_PATH', BASE_PATH.'/src/Resources/views');
        define('TEMPLATE_URI', BASE_URI.'/src/Resources/views');

        // assets
        define('ASSET_PATH', BASE_PATH.'/src/Resources/assets/dist');
        define('ASSET_URI', BASE_URI.'/src/Resources/assets/dist');
    }
}
