<?php

require_once ROOT . '/models/Cart.php';
require_once ROOT . '/libs/SimpleImage.php';
require_once ROOT . '/libs/OrderItem.php';
require_once ROOT . '/libs/Order.php';
require_once ROOT . '/libs/functions.php';

class CartController {

	public function actionIndex()
	{
		Cart::init();
		return true;
	}

	function actionAdd()
	{
		$pictures = reArrayFiles($_FILES['itemPic']);
		$frames = reArrayJson($_POST['itemFrame']);
		$text = isset($_POST['itemText']) ? $_POST['itemText'] : '';
		$itemId = intval($_POST['itemId']);

		$item = null;

		if (count($pictures) == 1) { // для товаров с одной картинкой
			if ($text !== "") { // с текстом
				if (count($frames) !== 0) { // с областью для обрезки
					$item = new OrderItem($itemId, count(Cart::getItems()), $pictures, $frames, $text);
				} else // без области для обрезки
					$item = new OrderItem($itemId, count(Cart::getItems()), $pictures, null, $text);
			} else { // без текста с одной картинкой
				$item = new OrderItem($itemId, count(Cart::getItems()), $pictures, $frames);
			}
		}
		elseif (count($pictures) > 1) { // itemPic + i для множества картинок
			$item = new OrderItem($itemId, count(Cart::getItems()), $pictures, $frames);
		} else // для статичных товаров
			$item = new OrderItem($itemId, count(Cart::getItems()));

		Cart::add($item);
		echo json_encode("ok");
		return true;
	}

	function actionClear()
	{
		Cart::clear();
		Cart::init();
		echo json_encode('Пусто');
		return true;
	}

	function actionRemove()
	{
		$itemNumber = intval($_GET['itemNumber']);
		Cart::remove($itemNumber);
		return true;
	}

	function actionGet()
	{
		$itemsToShow = Cart::getItemsForCart();
		include ROOT . '/views/cart.php';
		return true;
	}

	function actionDelete()
	{
		return true;
	}

	function actionBuy()
	{
		if (isset($_GET['description']) && isset($_GET['name']) && isset($_GET['address']) &&
			isset($_GET['email']) && isset($_GET['phone']) && count(Cart::getItems()) != 0) {

			Cart::buy(new Order($_GET['description'], $_GET['name'], $_GET['email'], $_GET['phone'],
				$_GET['address']));
			echo json_encode(true);
		} else
			echo json_encode(false);
		return true;
	}
}
