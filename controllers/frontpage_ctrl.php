<?php

require_once P_MODELS . 'page.php';
require_once P_MODELS . 'board.php';

class frontpageController extends Page {

    public function __construct()
    {
        $this->register_template("frontpage.html");

        $boards = Board::get_list_boards();

        $this->register_param_template([
            'boards' => $boards
        ]);
    }
}