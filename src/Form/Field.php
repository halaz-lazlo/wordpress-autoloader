<?php

namespace HL\WPAutoloader\Form;

use HL\WPAutoloader\Util\View;

class Field
{
    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_IMAGE = 'image';
    const TYPE_IMAGES = 'images';

    private $id;
    private $name;
    private $type;
    private $value;
    private $label;
    private $placeholder = '';
    private $isTranslatable = false;

    public static function create(string $name, string $type, string $label, string $placeholder = '')
    {
        return new self(
            $name,
            $type,
            $label,
            $placeholder,
            false
        );
    }

    public static function createTranslatable(string $name, string $type, string $label, string $placeholder = '')
    {
        return new self(
            $name,
            $type,
            $label,
            $placeholder,
            true
        );
    }

    public function __construct(string $name, string $type, string $label, string $placeholder = '', bool $isTranslatable = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->isTranslatable = $isTranslatable;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isTranslatable()
    {
        return $this->isTranslatable;
    }

    public function renderWidget()
    {
        View::Render('form/field/widget.php', [
            'field' => $this
        ]);
    }

    public function renderLabel()
    {
        View::render('form/field/components/label.php', [
            'field' => $this
        ]);
    }

    public function renderInput()
    {
        View::render('form/field/components/input-' . $this->getType() . '.php', [
            'field' => $this
        ]);
    }
}
