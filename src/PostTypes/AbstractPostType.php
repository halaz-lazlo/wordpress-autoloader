<?php

namespace HL\WPAutoloader\PostTypes;

class AbstractPostType
{
    protected $options;

    public function init()
    {
        if (isset($this->options['customs_form'])) {
            add_action('add_meta_boxes', array($this, 'showEditCustomsBox'));

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
        $postType = $this->options['post_type'];

        $options = [
            'id'       => "{$postType}_settings",
            'title'    => __('Settings', 'wpa'),
            'page'     => $postType,
            'context'  => 'normal',
            'priority' => 'high'
        ];

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
