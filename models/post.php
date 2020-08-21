<?php

class Post
{
  public $author = "";
  public $num = -1;
  public $comment = "";
  public $image_link = "";
  public $creation;

  public function __construct($author, $comment, $image_link, $num, $creation)
  {
    $this->author = $author;
    $this->num = $num;
    $this->comment = $comment;
    $this->image_link = $image_link;
    $this->creation = $creation;
  }

  static public function from_database_row($row) 
  {
    return new Post(
      $row['author'],
      $row['comment'],
      $row['image_link'],
      $row['id'],
      $row['creation']
    );
  }
}