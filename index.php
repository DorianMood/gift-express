<?php
// FRONT CONTROLLER

// Общие настройки

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Подключение файлов системы

define('ROOT', dirname(__FILE__));
define('ASSETS', ROOT.'/config/assets.php');
define('UPLOAD_DIR', ROOT . '/uploads');

require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/vendor/autoload.php'); // composer libs

foreach (scandir(ROOT . '/libs') as $file)
	if ($file !== "." && $file !== "..")
		require_once ROOT . '/libs/' . $file;

// Установка соединения с БД

// Вызор Router
$router = new Router();
$router->run();
