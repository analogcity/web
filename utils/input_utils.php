<?php

abstract class InputUtils
{
  // Non declarable class
  private function __construct()
  { }

  // Check if vars are set and not empty
  public static function validatePOST(array $vars_to_check_for): bool
  {

    foreach ($vars_to_check_for as $var) {
      if (!isset($_POST[$var]) || empty($_POST[$var])) {
        return false;
        break;
      }
    }
    return true;
  }

  // Check if vars are set and not empty
  public static function validateGET(array $vars_to_check_for): bool
  {

    foreach ($vars_to_check_for as $var) {
      if (!isset($_GET[$var]) || empty($_GET[$var])) {
        return false;
      }
    }
    return true;
  }

  public static function get_input_int(string $var_to_get, int $type_input) {
    return (int)filter_input($type_input, $var_to_get, FILTER_SANITIZE_NUMBER_INT);
  }

  public static function get_input_str(string $var_to_get, int $type_input) {
    return (string)filter_input($type_input, $var_to_get, FILTER_SANITIZE_STRING);
  }
}
