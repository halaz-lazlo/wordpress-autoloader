<?php

namespace HL\WPAutoloader\Repositories;

use HL\WPAutoloader\Media\Image;

class ImageRepository
{
    /**
     * @return Image
     */
    public function findById($id, $size = Image::SIZE_FULL, $attrs = ['src', 'alt'])
    {
        $src = in_array('src', $attrs) ? $this->getSrc($id, $size) : null;
        $alt = in_array('alt', $attrs) ? $this->getAlt($id) : null;

        return new Image($src, $alt);
    }

    public function getSrc($id, $size = Image::SIZE_FULL)
    {
        return wp_get_attachment_image_src($id, $size)[0];
    }

    public function getAlt($id)
    {
        return get_post_meta($id, '_wp_attachment_image_alt', true);
    }
}
