<?php

require_once P_MODELS . 'page.php';
require_once P_MODELS . 'board.php';

class boardController extends Page {

    public function __construct()
    {
        if (!InputUtils::validateGET(['b'])) {
            redirect(HOME);
        }

        $board = InputUtils::get_input_str('b', INPUT_GET);
        $threads = Board::get_threads_in_board($board);

        $this->register_template('board.html');
        $this->register_param_template([
            'threads' => $threads,
            'board' => $board
        ]);
    }
}