<?php

use Medoo\Medoo;

class Orders {
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
		$items = self::$db->select('orders', '*');
		return $items;
	}

	static function selectById($id) {
		if (self::$db === null)
			self::init();
		return self::$db->select('orders', '*', [
			'id' => $id
		])[0];
	}

	static function markOrder($id, $mark) {
		if (self::$db === null)
			self::init();

		self::$db->update('orders',[
				'done' => $mark
			], [
			'id' => $id
		]);
	}

	static function unmarkOrder($id) {
		if (self::$db === null)
			self::init();

		self::$db->update('orders',[
			'done' => 0
		], [
			'id' => $id
		]);
	}

	static function deleteOrder($id) {
		if (self::$db === null)
			self::init();

		self::$db->delete('orders',[
			'id' => $id
		]);
	}

}