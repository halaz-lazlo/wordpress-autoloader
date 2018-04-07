<?php

namespace HL\WPAutoloader\Forms;

use HL\WPAutoloader\Forms\iForm;

abstract class AbstractForm implements iForm
{
    protected $options;

    public function getForm()
    {
        return $this->options['form'];
    }

    public function init()
    {
        $this->options['form']['action'] = admin_url('admin-ajax.php?action='. $this->options['form']['id'] .'_submit');

        // insert
        add_action('wp_ajax_'.$this->options['form']['id'].'_submit', array($this, 'submit'));
        add_action('wp_ajax_nopriv_'.$this->options['form']['id'].'_submit', array($this, 'submit'));

        // admin
        add_action('admin_menu', [$this, 'init_menu_page']);
    }

    /**
     * create a menu on admin sidebar
     */
    public function init_menu_page()
    {
        add_menu_page(
            $this->options['menu_page']['label'],
            $this->options['menu_page']['label'],
            'manage_options',
            'wpa_'.$this->options['form']['id'],
            array(&$this, 'list_entries'),
            $this->options['menu_page']['icon'],
            39
        );
    }

    public function submit()
    {
        echo "Function not implemented";
        exit;
    }

    public function list_entries()
    {
        echo "Function not implemented";
    }
}
