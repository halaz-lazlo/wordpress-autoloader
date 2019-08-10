<?php

namespace HL\WPAutoloader\PostType;

use HL\WPAutoloader\Form\Form;
use HL\WPAutoloader\Util\View;

class CustomPostType
{
    private $postType = null;
    private $options = null;
    private $customsForm = null;


    public function __construct(string $postType, array $options, Form $customsForm = null)
    {
        $this->postType = $postType;
        $this->options = $options;
        $this->customsForm = $customsForm;
    }

    public function init()
    {
        $this->register();
        $this->initCustomsForm();
    }

    public function register()
    {
        if ($this->options) {
            register_post_type($this->postType, $this->options);
        } else {
            throw new \Exception('Set the post type features');
        }
    }

    public function initCustomsForm()
    {
        if ($this->customsForm) {
            $this->customsForm->init();
            if ($this->customsForm) {
                add_action('add_meta_boxes', array($this, 'showEditCustomsBox'));

                add_action('save_post', array($this, 'saveCustoms'));
            }
        }
    }

    /**
     * show edit customs box
     */
    public function showEditCustomsBox()
    {
        $options = [
            'id'       => "{$this->postType}_settings",
            'title'    => __('Settings', 'wpa'),
            'page'     => $this->postType,
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

        $this->customsForm->preload($post);

        View::render('admin/custom-post-type/customs-form.php', ['customsForm' => $this->customsForm]);
    }

    /**
     * Action on saving post data on admin
     */
    public function saveCustoms($post_id)
    {
        foreach ($this->customsForm->getFields() as $field) {
            echo $field->getId() . '<br>';
            if (isset($_POST[$field->getId()])) {
                $value = $_POST[$field->getId()];
                $value = is_array($value) ? $value[0] : $value;

                echo $field->getId() . ' ' . $value . '<br>';

                update_post_meta($post_id, $field->getId(), $value);
            } else {
                delete_post_meta($post_id, $field->getId());
            }
        }
    }

    /**
     * return the form
     */
    public function getCustomsForm()
    {
        return $this->customsForm;
    }
}
