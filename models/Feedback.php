<?php

use Medoo\Medoo;

class Feedback {
	private static $config;
	private static $db = null;

	function __construct() { }

	public static function init() {
		self::$config = include(ROOT.'/config/database.php');
		self::$db = new Medoo(self::$config);
	}

	static function selectAll() {
		if (self::$db === null)
			self::init();
		$items = self::$db->select('feedback', '*');
		return $items;
	}

	static function selectByItemId($id) {
		if (self::$db === null)
			self::init();
		return self::$db->select('feedback', '*', [
			'item_id' => $id
		]);
	}

	static function deleteOrder($id) {
		if (self::$db === null)
			self::init();

		self::$db->delete('feedback',[
			'id' => $id
		]);
	}

}