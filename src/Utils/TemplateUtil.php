<?php

namespace HL\WPAutoloader\Utils;

class TemplateUtil
{
    private $basePath;
    private $alternatePath;

    public function __construct()
    {
        $this->basePath = __DIR__.'/../Resources/views';
    }

    public function render($tmpl, $data = array(), $getContent = false)
    {
        return $this->renderDefault($tmpl, $data, $getContent);
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
