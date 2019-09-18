<?php

namespace HL\WPAutoloader\Media;

class Image
{
    public const SIZE_FULL = 'full';
    public const SIZE_LG = 'lg';

    private $src;
    private $alt;
    private $title;


    public function __construct($src, $alt, $title)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->title = $title;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
