<?php

namespace HL\WPAutoloader\Media;

class Image
{
    public const SIZE_FULL = 'full';
    public const SIZE_LG = 'lg';

    private $src;
    private $alt;


    public function __construct($src, $alt)
    {
        $this->src = $src;
        $this->alt = $alt;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function getAlt()
    {
        return $this->alt;
    }
}
