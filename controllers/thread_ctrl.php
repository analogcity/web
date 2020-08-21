<?php

require_once P_MODELS . 'page.php';
require_once P_MODELS . 'thread.php';

class threadController extends Page
{
    public function __construct()
    {
        if (!InputUtils::validateGET(['b','n'])) {
            redirect(HOME);
        }

        $board = InputUtils::get_input_str('b', INPUT_GET);
        $thread_id = InputUtils::get_input_int('n', INPUT_GET);

        $this->register_template('thread.html');
        $this->register_param_template([
            'board' => $board,
            'op' => Thread::get_op_in_thread($thread_id),
            'posts' => Thread::get_posts_in_thread($thread_id)
        ]);
    }
}