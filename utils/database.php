<?php

require_once 'db_config.php';
require_once P_MODELS . 'singleton.php';

class DataBase extends Singleton
{

  private static $servername = DB_HOST;
  private static $username = DB_USER;
  private static $password = DB_PASS;
  private static $db_name = DB_NAME;

  private $conn;
  private $last_query_res;

  protected function __construct()
  {
    $this->conn = new mysqli(self::$servername, self::$username, self::$password, self::$db_name);
    if ($this->conn->connect_error) {
      die('Connection error: ' . $this->conn->connect_error);
    }
    $this->conn->set_charset("utf8");

    $this->last_query_res = [];
  }

  public function closeConnection()
  {
    $this->conn->close();
    self::destroyInstance();
  }

  public function safe_query(string $prepared_statement, array $ordered_params, string $ordered_params_types, bool $store_result = true): bool
  {
    $params = [];

    // Move all to pointers
    $params[] = &$ordered_params_types;
    for ($i = 0; $i < count($ordered_params); $i++) {
      $params[] = &$ordered_params[$i];
    }

    // Prepare statement
    $stmt = $this->conn->prepare($prepared_statement);
    if ($stmt === false) return false;

    // Pass the array of parameters to be called dynamicaly
    call_user_func_array(array($stmt, 'bind_param'), $params);

    // Execute querry
    if ($stmt->execute() === false) return false;

    if ($store_result) {
      // Clean array 
      $this->last_query_res = [];
      $res = $stmt->get_result();
      if ($res === false) return false;
      while (($row = $res->fetch_array(MYSQLI_BOTH))) {
        array_push($this->last_query_res, $row);
      }

      // $stmt->close();
    }

    return true;
  }

  public function unsafe_query(string $query, bool $store_result = true): bool
  {
    if(($res = $this->conn->query($query)) === false) return false;

    if ($store_result) {
      $this->last_query_res = [];
      while (($row = $res->fetch_array(MYSQLI_BOTH))) {
        array_push($this->last_query_res, $row);
      }
    }

    return true;
  }

  public function get_result()
  {
    $placeholder = $this->last_query_res;
    $this->last_query_res = [];

    return $placeholder;
  }
}