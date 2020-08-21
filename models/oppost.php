<?php

require_once P_MODELS . 'post.php';


class OPpost extends Post
{
  public $title = "";

  public function __construct($title, $author, $comment, $image_link, $num, $creation)
  {
    parent::__construct($author, $comment, $image_link, $num, $creation);
    $this->title = $title;
  }

  static public function from_database_row($row)
  {
    return new OPpost(
      $row['title'],
      $row['author'],
      $row['comment'],
      $row['image_link'],
      $row['id'],
      $row['creation']
    );
  }
}