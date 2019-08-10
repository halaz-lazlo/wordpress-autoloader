<?php

namespace HL\WPAutoloader\Util;

class View
{
    const BASE_PATH = __DIR__.'/../Resources/views';


    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public static function render($tmpl, $data = array(), $getContent = false)
    {
        extract($data);

        $filePath = TEMPLATE_PATH.'/'.$tmpl;

        if (!file_exists($filePath)) {
            $filePath = self::BASE_PATH.'/'.$tmpl;
        }

        if (!file_exists($filePath)) {
            echo "Nincs ilyen file: ". self::BASE_PATH.'/'.$tmpl;
            exit;
        }

        if ($getContent) {
            ob_start();
            require($filePath);
            return ob_get_clean();
        }
        else {
            include $filePath;
        }
    }

    public function renderDefault($tmpl, $data = array(), $getContent = false)
    {
        extract($data);

        $filePath = TEMPLATE_PATH.'/'.$tmpl;

        if (!file_exists($filePath)) {
            $filePath = $this->basePath.'/'.$tmpl;
        }

        if (!file_exists($filePath)) {
            echo "Nincs ilyen file: ". TEMPLATE_PATH.'/'.$tmpl;
            exit;
        }

        if ($getContent) {
            ob_start();
            require($filePath);
            return ob_get_clean();
        }
        else {
            include $filePath;
        }
    }
}
