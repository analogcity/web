<?php

abstract class Page {

    private $template = 'no_template.html';
    private $func_render = 'default_render';
    private $param_template = [];

    private function default_render()
    {
        global $twig;
        echo $twig->render($this->template, $this->param_template);
    }

    public function render()
    {
        $this->{ $this->func_render }();
    }

    protected function register_param_template(array $params)
    {
        foreach ($params as $key => $value) {
            $this->param_template[$key] = $value;
        }
    }

    protected function register_func_render(string $func_render)
    {
        $this->func_render = $func_render;
    }

    protected function register_template(string $template)
    {
        $this->template = $template;
    }

}