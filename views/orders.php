<?php
require_once ROOT . '/models/Orders.php';

foreach (Orders::selectAll() as $order) {
	echo "<div class=\"admin-order-row\">";
	echo $order['id'] . " " . $order['description'] . " " . $order['date'] . " " . $order['done'];
	//echo $_SERVER['REQUEST_URI'];	
	echo "<a href=\"/site/admin/mark?id=" . $order['id'] . "\"> Выполнено! </a>";
	echo "<a href=\"/site/admin/unmark?id=" . $order['id'] . "\"> Не выполнено. </a>";
	echo "<a href=\"/site/admin/delete?id=" . $order['id'] . "\"> Удалить. </a>";
	echo "</div><br/>";
}