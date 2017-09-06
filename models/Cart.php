<?php

use Medoo\Medoo;
require_once ROOT . '/libs/Order.php';

class Cart {
	private static $items;
	private static $order;
	private static $sessionItemsName = 'cart_items';
	private static $config;
	private static $db = null;

	public static function initDB() {
		self::$config = include(ROOT.'/config/database.php');
		self::$db = new Medoo(self::$config);
	}

	function __construct() { }

	public static function init() {
		self::$items = [];
		$_SESSION[self::$sessionItemsName] = serialize(self::$items);
	}

	public static function add($item) {
		if (!isset($_SESSION[self::$sessionItemsName]))
			self::init();
		self::$items = unserialize($_SESSION[self::$sessionItemsName]);
		array_push(self::$items, $item);
		$_SESSION[self::$sessionItemsName] = serialize(self::$items);
	}

	public static function getItems() {
		if (!isset($_SESSION[self::$sessionItemsName]))
			self::init();
		self::$items = unserialize($_SESSION[self::$sessionItemsName]);

		return self::$items;
	}

	public static function getItemsForCart() {
		$itemsDB = [];

		if (self::$db === null)
			self::initDB();

		self::$items = self::getItems();
		foreach (self::$items as $item) {
			$itemDB = self::$db->select('items', ['picture', 'cost', 'name'], [
				'id' => $item->itemId]);
			$itemDB['itemNumber'] = $item->itemNumber;
			array_push($itemsDB, $itemDB);
		}

		return $itemsDB;
	}

	public static function clear() {
		$_SESSION[self::$sessionItemsName] = serialize(array());
	}

	public static function remove($id) {
		self::$items = unserialize($_SESSION[self::$sessionItemsName]);
		foreach (self::$items as $key => $item)
			if (self::$items[$key]->itemNumber === $id)
				unset(self::$items[$key]);
		$_SESSION[self::$sessionItemsName] = serialize(self::$items);
	}

	public static function buy($order) {

		if (self::$db === null)
			self::initDB();

		self::$db->insert('orders',[
			'description' => $order->description,
			'email' => $order->email,
			'phone' => $order->phone,
			'name' => $order->name,
			'address' => $order->address
			]);

		$order->id = intval(self::$db->select('orders', 'id', ['ORDER' => ['orders.id' => 'DESC'],	'LIMIT' => 1])[0]);
		//$order->items = self::$items;

		//var_dump(self::$items);

		foreach (self::$items as $item) {
			$item->saveContent();
			$text = '';
			if ($item->content !== null && $item->content->text !== null)
				$text = $item->content->text;


			self::$db->insert('order_item',[
				'order_id' => $order->id,
				'item_id' => $item->itemId,
				'text' => $text
				]);

			$insertedId = intval(self::$db->select('order_item', 'id', ['ORDER' => ['order_item.id' => 'DESC'], 'LIMIT' => 1])[0]);

			//var_dump($item->content->pictures);

			if ($item->content !== null && $item->content->pictures !== null)
				foreach ($item->content->pictures as $picture) {
					//$picture->save();
					self::$db->insert('pictures', [
						'order_item_id' => $insertedId,
						'path' => $picture->path
						]);
				}

		}
	}
}