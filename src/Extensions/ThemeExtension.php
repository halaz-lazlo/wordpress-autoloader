<?php

namespace HL\WPAutoloader\Extensions;

class ThemeExtension
{
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function init()
    {
        if (isset($this->options['theme_settings'])) {
            $this->options = $this->options['theme_settings'];

            add_action('admin_menu', array($this, 'add_menu'));
            add_action('admin_init', array($this, 'register_settings'));
        }
    }

    /**
     * add menu item to left sidebar
     */
    public function add_menu()
    {
        $options = $this->options;

        add_menu_page(
            $options['menu_label'],
            $options['menu_label'],
            'manage_options',
            'theme-settings',
            array(&$this, 'renderForm'),
            '',
            40
        );
    }

    /**
     * registering custom settings
     * @return void
     */
    public function register_settings()
    {
        $formFields = $this->options['form_fields'];

        foreach ($formFields as $key => $setting) {
            register_setting('wpa_theme_settings', $key);
        }
    }

    /**
     * globals menu edit form
     * @return void
     */
    public function renderForm()
    {
        global $app;

        $formFields = $this->options['form_fields'];

        $app->render('admin/extensions/theme/edit.php', ['settings' => $formFields]);
    }
}
