<?php

abstract class ControllerFactory
{

  // No es pot declarar
  private function __construct()
  { }

  public static function load_controller(string $controller, string $ctrl_on_error)
  {

    $path = 'controllers/';
    // if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === "XMLHttpRequest") {
    //   $path = $path . 'ajax_';
    // }

    if (file_exists($path . $controller . '_ctrl.php')) {

      require_once($path . $controller . '_ctrl.php');

    } else {

      $controller = $ctrl_on_error;
      require_once($path . $controller . '_ctrl.php');
    }

    $controller = str_replace('-', '_', $controller);
    $controller = $controller . 'controller';
    return new $controller();
  }
}