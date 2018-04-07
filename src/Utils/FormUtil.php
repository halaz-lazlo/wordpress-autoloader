<?php

namespace HL\WPAutoloader\Utils;

use HL\WPAutoloader\Utils\TemplateUtil;

class FormUtil
{
    private $templateUtil;

    public function __construct()
    {
        $this->templateUtil = new TemplateUtil();
    }

    public function loadData($post, &$form)
    {
        foreach ($form['fields'] as $key => $input) {
            $inputId = $this->inputId($form, $key);
            $form['fields'][$key]['value'] = get_post_meta($post->ID, $inputId, true);
        }

        return $form;
    }

    /**
     * render a full form
     * @param  array $form the form itself
     */
    public function createView($form)
    {
        $this->templateUtil->render('form/layout.php', ['form' => $form]);
    }

    /**
     * render the <form> start tag of the form
     * @param  array $form the form itself
     */
    public function start($form, $classes = [])
    {
        $this->templateUtil->render('form/layout/start.php', [
            'form'    => $form,
            'classes' => $classes
        ]);
    }

    /**
     * render an item of the form
     * @param  array $form the form itself
     * @param  string $inputKey the input key
     */
    public function widget($form, $inputName)
    {
        if (isset($form['fields'][$inputName])) {

            $this->templateUtil->render('form/layout/widget.php', [
                'form'      => $form,
                'input_name' => $inputName,
                'input_id'  => $this->inputId($form, $inputName)
            ]);
        } else {
            echo 'There is no field like: '.$inputName.'<br>';
        }
    }

    /**
     * render the </form> end tag of the form
     * @param  array $form the form itself
     */
    public function end($form)
    {
        $this->templateUtil->render('form/layout/end.php', ['form' => $form]);
    }

    /**
     * fill form with values
     */
    public function handleForm(&$form)
    {
        foreach ($form['fields'] as $key => $field) {
            $fieldKey = $this->inputId($form, $key);
            $value    = (isset($_POST[$fieldKey])) ? $_POST[$fieldKey] : null;
            $value    = is_array($value) ? implode(' ', $value) : $value;

            $form['fields'][$key]['value'] = $value;
        }
    }

    /**
     * Validate a form
     */
    public function validate($form)
    {
        $errors = [];

        foreach ($form['fields'] as $fieldKey => $field) {
            if (isset($field['validate']) && sizeof($field['validate']) > 0) {
                foreach ($field['validate'] as $validation => $errorMessage) {
                    $inputId = $this->inputId($form, $fieldKey);
                    $value = (isset($field['value'])) ? $field['value'] : null;

                    // not blank
                    if ($validation == 'not_blank') {

                        if (!$value) {
                            $errors[$inputId][] = $errorMessage;
                        }
                    }

                    // email
                    if ($validation == 'email') {

                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$inputId][] = $errorMessage;
                        }
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * Get entity to save
     */
    public function getEntityToSave($form)
    {
        $entity = [];

        foreach ($form['fields'] as $fieldKey => $field) {
            $value = isset($field['value']) ? $field['value'] : null;

            $entity[$fieldKey] = $value;
        }

        return $entity;
    }

    public function inputId($form, $inputName)
    {
        return $form['id'].'_'.$inputName;
    }
}
