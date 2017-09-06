<?php
require_once ROOT . '/models/Items.php';
use Medoo\Medoo;

class ItemsController {
	function actionIndex() {
		Items::init();
		include ROOT . '/views/item.php';
		return true;
	}
}
