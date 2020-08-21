<?php

require_once P_MODELS . 'page.php';

class errorController extends Page
{
    public function __construct()
    {
        $this->register_template('404.html');
    }
}