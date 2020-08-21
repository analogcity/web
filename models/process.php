<?php

require_once P_MODELS . 'page.php';

abstract class Process extends Page {

    private $func_exec = 'default_execution';
    private $redirect = HOME;

    public function __construct()
    {}

    public function execute()
    {
        $this->{ $this->func_exec }();
        header($this->redirect);
    }

    protected function register_func_executable(string $f)
    {
        $this->func_exec = $f;
    }

    protected function register_redirect(string $redirect)
    {
        $this->redirect = $redirect;
    }

    private function default_execution()
    {
        die('No specified process to execute');
    }

}