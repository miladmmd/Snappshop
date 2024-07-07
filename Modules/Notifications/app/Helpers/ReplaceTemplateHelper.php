<?php

namespace Modules\Notifications\Helpers;

class ReplaceTemplateHelper
{
    protected $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function __invoke(array $data)
    {
        return $this->replacePlaceholders($this->template, $data);
    }

    protected function replacePlaceholders($template, $data)
    {
        foreach ($data as $key => $value) {
            $template = str_replace(':' . $key, $value, $template);
        }
        return $template;
    }
}
