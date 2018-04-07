<?php

namespace HL\WPAutoloader;

class Assets
{
    private $basePath;
    private $baseUri;

    public function __construct()
    {
        $this->basePath = __DIR__.'/Resources/assets/dist';
        $this->baseUri = SITE_URI.'/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__).'/Resources/assets/dist';
    }

    public function init()
    {
        // admin assets
        add_action('admin_enqueue_scripts', array($this, 'wpaAdminAssets'));
        add_action('login_enqueue_scripts', array($this, 'wpaAdminAssets'));

        // sindle assets
        add_action('wp_enqueue_scripts', array($this, 'wpaAssets'), 100);
    }

    /**
     * include admin assets
     */
    public function wpaAdminAssets()
    {
        $cssPath = $this->basePath.'/css/admin.min.css';
        $cssUri = $this->baseUri.'/css/admin.min.css';

        if (!file_exists($cssPath)) {
            echo "Nincs ilyen file: ". $cssPath;
            exit;
        } else {
            wp_register_style(
                'wp-autoloader-styles-admin',
                $cssUri,
                [],
                filemtime($cssPath),
                'all'
            );
            wp_enqueue_style('wp-autoloader-styles-admin');
        }
    }

    public function wpaAssets()
    {
        wp_dequeue_style('js_composer_front');
    }
}
