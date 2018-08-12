<?php

namespace HL\WPAutoloader;

// services
use HL\WPAutoloader\Settings;
use HL\WPAutoloader\Supports;
use HL\WPAutoloader\Resets;
use HL\WPAutoloader\Filters;
use HL\WPAutoloader\Assets;
use HL\WPAutoloader\Shortcodes;

// extensions
use HL\WPAutoloader\Extensions\ThemeExtension;

// utils
use HL\WPAutoloader\Utils\FormUtil;
use HL\WPAutoloader\Utils\TemplateUtil;
use HL\WPAutoloader\Utils\MenuUtil;

class App
{
    protected $services;
    protected $extensions;
    protected $utils;
    protected $forms;

    public function init()
    {
        // init settings
        $this->services['settings'] = new Settings();
        $this->services['settings']->init();

        // get parameters
        include BASE_PATH.'/src/Resources/config/parameters.php';

        // init features
        $this->services['features'] = new Features();
        $this->services['features']->init($parameters);

        // init resets
        $this->services['resets'] = new Resets();
        $this->services['resets']->init();

        // init filters
        $this->services['filters'] = new Filters();
        $this->services['filters']->init();

        // init assets
        $this->services['assets'] = new Assets();
        $this->services['assets']->init();

        // init extensions
        $this->extensions['theme'] = new ThemeExtension($parameters);
        $this->extensions['theme']->init();

        // init utils
        $this->utils['template'] = new TemplateUtil();
        $this->utils['form'] = new FormUtil();
        $this->utils['menu'] = new MenuUtil();

        global $app;
        $app = $this;

        return $this;
    }

    public function getUtil($util)
    {
        if (!array_key_exists($util, $this->utils)) {
            echo 'Utils unavailable: '.$util;
            die();
        }

        return $this->utils[$util];
    }

    public function getForm($form)
    {
        if (!isset($this->forms) || !array_key_exists($form, $this->forms)) {
            echo 'Form unavailable: '.$form;
            die();
        }

        return $this->forms[$form]->getForm();
    }

    public function render($tmpl, $data = array(), $getContent = false)
    {
        return $this->getUtil('template')->render($tmpl, $data, $getContent);
    }
}
