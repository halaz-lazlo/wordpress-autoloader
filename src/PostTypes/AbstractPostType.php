<?php

namespace HL\WPAutoloader\PostTypes;

class AbstractPostType
{
    protected $options;

    public function init()
    {
        if (isset($this->options['customs_box'])) {
            add_action('admin_menu', array($this, 'showEditCustomsBox'));
        }

        if (isset($this->options['customs_form'])) {
            add_action('save_post', array($this, 'saveCustoms'));
        }

        if (isset($this->options['post_type'])) {
            if (isset($this->options['post_type_features'])) {
                register_post_type($this->options['post_type'], $this->options['post_type_features']);
            } else {
                echo 'set the post type features';
            }
        }
    }

    /**
     * show edit customs box
     */
    public function showEditCustomsBox()
    {
        $optionsDefault = [
            'id'       => 'page_settings',
            'title'    => __('Page settings', 'wpa'),
            'page'     => 'page',
            'context'  => 'normal',
            'priority' => 'high'
        ];

        $options = array_merge($optionsDefault, $this->options['customs_box']);

        add_meta_box(
            $options['id'],
            $options['title'],
            array($this,'showEditCustomsForm'),
            $options['page'],
            $options['context'],
            $options['priority']
        );
    }

    /**
     * rendering edit box
     */
    public function showEditCustomsForm($post)
    {
        global $app;

        $formUtil = $app->getUtil('form');
        $form = $this->options['customs_form'];

        if ($form) {
            $formUtil->loadData($post, $form);
            $app->render('admin/post-types/layout.php', ['form' => $form]);
        }
    }

    /**
     * Action on saving post data on admin
     */
    public function saveCustoms($post_id)
    {
        global $app;
        $formUtil = $app->getUtil('form');
        $form = $this->options['customs_form'];

        foreach ($form['fields'] as $key => $value) {
            $inputId = $formUtil->inputId($form, $key);

            if (isset($_POST[$inputId])) {
                $value = $_POST[$inputId];
                $value = is_array($value) ? $value[0] : $value;

                update_post_meta($post_id, $inputId, $value);
            } else {
                delete_post_meta($post_id, $inputId);
            }
        }
    }

    /**
     * return the form
     */
    public function getEditCustomsForm()
    {
        return $this->form;
    }
}
