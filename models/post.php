<?php

class Post
{
  public $author = "";
  public $num = -1;
  public $comment = "";
  public $creation;

  public function __construct($author, $comment, $num, $creation)
  {
    $this->author = $author;
    $this->num = $num;
    $this->comment = $comment;
    $this->creation = $creation;
  }

  static public function from_database_row($row) 
  {
    return new Post(
      $row['author'],
      $row['comment'],
      $row['id'],
      $row['creation']
    );
  }
}