<?php

class Board
{
    const BOARDS_QUERY = "SELECT link, name, description FROM board";
    const THREADS_IN_BOARD_QUERY = "SELECT id, title, author, comment, image_link, creation, last_rp, replays FROM thread WHERE table_id = (SELECT id FROM board WHERE link = ?) ORDER BY last_rp DESC LIMIT 25";

    public $link;
    public $name;
    public $desc;

    public function __construct($name, $link, $desc)
    {
      $this->link = $link;
      $this->name = $name;
      $this->desc = $desc;
    }

    public static function get_list_boards() : array
    {
        $db = DataBase::getInstance();
        
        if (!$db->unsafe_query(self::BOARDS_QUERY)) {
            if (DEBUG) {
                echo var_dump($db);
                die('querry error on get_list_boards');
            } else {
                redirect(FOUR_O_FOUR);
            }
        }

        $res = $db->get_result();
        $boards = [];

        foreach ($res as $board) {
            $boards[] = new Board($board['name'], $board['link'], $board['description']);
        }

        return $boards;
    }

    public static function get_threads_in_board(string $board_link) : array
    {
        require_once P_MODELS . 'thread.php';
        $db = DataBase::getInstance();

        $ok = $db->safe_query(
            self::THREADS_IN_BOARD_QUERY,
            [$board_link],
            's'
        );

        if (!$ok) {
            // wrong board link probably
            if (DEBUG) {
                echo var_dump($db);
                die('querry error on get_threads_in_board');
            } else {
                redirect(FOUR_O_FOUR);
            }
        }

        $res = $db->get_result();
        $threads = [];
        foreach ($res as $row) {
            $threads[] = Thread::from_database_row($row);
        }

        return $threads;
    }
}