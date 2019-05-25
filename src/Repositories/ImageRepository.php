<?php

namespace HL\WPAutoloader\Repositories;

class ImageRepository
{
    public function findById($id, $attrs = ['src', 'alt'], $size = 'full')
    {
        $img = [];

        if (in_array('src', $attrs)) {
            $img['src'] = $this->getSrc($id, $size);
        }

        if (in_array('alt', $attrs)) {
            $img['alt'] = $this->getAlt($id);
        }

        return $img;
    }

    public function getSrc($id, $size = 'full')
    {
        return wp_get_attachment_image_src($id, $size)[0];
    }

    public function getAlt($id)
    {
        return get_post_meta($id, '_wp_attachment_image_alt', true);
    }
}
