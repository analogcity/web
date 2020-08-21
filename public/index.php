<?php

// Change directory
chdir('..');

// Load configuration
require_once 'config.php';

// Get controler
if (InputUtils::validateGET(['p'])) {
    $controller = InputUtils::get_input_str('p', INPUT_GET);
}

// Get Action
if (InputUtils::validateGET(['a'])) {
    $action = InputUtils::get_input_str('a', INPUT_GET);
}

// Create Controler & execute it
$control = new Controller($controller, $action);
$control->execute();

// Close database connection
DataBase::destroyInstance();
