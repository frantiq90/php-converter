<?php

// Load required files
require('Controllers/MainController.php');
require('Controllers/CliController.php');
require('Controllers/ActionController.php');
require('Controllers/PreventController.php');
require('Handlers/HandlerInterface.php');
require('Handlers/JsonHandler.php');
require('Handlers/XmlHandler.php');
require('Handlers/CsvHandler.php');
require('Modules/BaseModule.php');
require('Modules/ImportModule.php');
require('Modules/ExportModule.php');

// Init main controller
$controller = new \Converter\Controllers\MainController();
$controller->init();

?>