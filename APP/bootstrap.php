<?php
session_start();
header("Access-Control-Allow-Origin: *");
//Load Configs
require_once '../APP/config/Config.php';

//Load Functions
require_once '../APP/functions/functions.php';

//Autoload Everything
spl_autoload_register(function($className) {

	$className = str_replace("\\", '/', $className);
	include_once '../' . $className . '.php';

});

//Init Core
$app = new APP\Core\Core;
