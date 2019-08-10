<?php

namespace HL\WPAutoloader\Form;

use HL\WPAutoloader\Util\View;
use HL\WPAutoloader\Form\Field;

class Form
{
    private $id;
    private $fields;
    private $method;

    public function __construct($id, $fields, $method = 'POST')
    {
        $this->id = $id;
        $this->fields = $fields;
        $this->method = $method;
    }

    public function init()
    {
        foreach ($this->fields as $i => $field) {
            if ($field->isTranslatable()) {
                $languages = get_option('qtranslate_enabled_languages');

                if ($languages) {
                    foreach ($languages as $j => $language) {
                        $translatedField = clone $field;
                        $translatedField->setName($translatedField->getName() . '_' . $language);

                        if ($translatedField->getLabel()) {
                            $translatedField->setLabel($translatedField->getLabel() . ' (' . $language . ')');
                        }

                        $this->fields[$i . '_' . $j] = $translatedField;
                    }

                    unset($this->fields[$i]);
                }
            }
        }

        foreach ($this->fields as $i => $field) {
            $id = $this->getFieldId($field);
            $field->setId($this->getFieldId($field));
        }
    }

    public function preload($post)
    {
        foreach ($this->fields as $field) {
            $id = $this->getFieldId($field);
            $field->setValue(get_post_meta($post->ID, $id, true));
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getFieldId($field)
    {
        return $this->id . '_' . $field->getName();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function render()
    {
        View::render('form/layout.php', ['form' => $this]);
    }
}
