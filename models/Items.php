<?php
use Medoo\Medoo;

class Items {
	private static $config;
	private static $db = null;

	function __construct() { }

	public static function init() {
		self::$config = include(ROOT.'/config/database.php');
		self::$db = new Medoo(self::$config);
	}

	public static function selectById($id) {
		$item = null;
		if (self::$db !== null)
			$item = self::$db->select('items', '*',[
				"id" => $id,
			]);
		else
			self::init();
		return $item;
	}

	public static function selectAll() {
		$items = null;
		if (self::$db !== null)
			$items = self::$db->select('items', '*');
		else {
			self::init();
			$items = self::$db->select('items', '*');
		}
		return $items;
	}
}