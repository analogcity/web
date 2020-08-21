<?php

class Thread
{

  const OP_QUERY = "SELECT id, title, author, comment, image_link, creation FROM thread WHERE id = ? LIMIT 1";
  const POSTS_QUERY = "SELECT id, author, comment, image_link, creation FROM post WHERE thread_id = ? ORDER BY creation";


  public $author = "";
  public $title = "";
  public $comment = "";
  public $imge_link = "";
  public $num = -1;
  public $creation;
  public $last_rp;
  public $n_replys;

  public function __construct($a, $t, $c, $i, $num, $creation, $last_rp, $n_replys)
  {
    $this->author = $a;
    $this->title = $t;
    $this->comment = $c;
    $this->imge_link = $i;
    $this->num = $num;
    $this->last_rp = $last_rp;
    $this->creation = $creation;
    $this->n_replys = $n_replys;
  }

  static public function from_database_row($row)
  {
    return new Thread(
      $row['author'],
      $row['title'],
      $row['comment'],
      $row['image_link'],
      $row['id'],
      $row['creation'],
      $row['last_rp'],
      $row['replays']
    );
  }

  static public function get_op_in_thread(int $thread_id)
  {
    require_once P_MODELS . 'oppost.php';
    $db = DataBase::getInstance();

    $ok = $db->safe_query(
      self::OP_QUERY,
      [$thread_id],
      'i'
    );

    if (!$ok) {
      if (DEBUG) {
        echo var_dump($db);
        die('querry error on get_op_in_thread');
      } else {
        redirect(FOUR_O_FOUR);
      }
    }

    foreach ($db->get_result() as $row) {
      return OPpost::from_database_row($row);
    }
  }

  static public function get_posts_in_thread(int $thread_id)
  {
    require_once P_MODELS . 'post.php';
    $db = DataBase::getInstance();

    $ok = $db->safe_query(
      self::POSTS_QUERY,
      [$thread_id],
      'i'
    );

    if (!$ok) {
      if (DEBUG) {
        echo var_dump($db);
        die('querry error on get_posts_in_thread');
      } else {
        redirect(FOUR_O_FOUR);
      }
    }

    $posts = [];
    foreach ($db->get_result() as $row) {
      $posts[] = Post::from_database_row($row);
    }

    return $posts;
  }
}