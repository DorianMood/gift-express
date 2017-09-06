<?php
require_once ROOT . '/models/Orders.php';
echo "<table class='table-table'>";
echo "<caption>Orders</caption>";
	echo "<tr class='table-row table-header'>";
		echo "<th class='table-cell'>id</th>";
		echo "<th class='table-cell'>files</th>";
		echo "<th class='table-cell'>description</th>";
		echo "<th class='table-cell'>name</th>";
		echo "<th class='table-cell'>phone</th>";
		echo "<th class='table-cell'>email</th>";
		echo "<th class='table-cell'>address</th>";
		echo "<th class='table-cell'>date</th>";
		echo "<th class='table-cell'>status</th>";
		echo "<th class='table-cell'></th>";
		echo "<th class='table-cell'></th>";
		echo "<th class='table-cell'></th>";
		echo "<th class='table-cell'></th>";
		echo "<th class='table-cell'></th>";
		echo "<th class='table-cell'></th>";
	echo "</tr>";
foreach (Orders::selectAll() as $order) {
	echo "<tr class='table-row'>";
		echo "<th class='table-cell'>".$order['id']."</th>";
		echo "<th class='table-cell'><a href='localhost/site/tmp/1.png' download>download</a></th>";
		echo "<th class='table-cell'>".$order['description']."</th>";
		echo "<th class='table-cell'>".$order['name']."</th>";
		echo "<th class='table-cell'>".$order['phone']."</th>";
		echo "<th class='table-cell'>".$order['email']."</th>";
		echo "<th class='table-cell'>".$order['address']."</th>";
		echo "<th class='table-cell'>".$order['date']."</th>";
		echo "<th class='table-cell'>".(intval($order['done'])===0?"принят":(intval($order['done'])===1?"согласован":(intval($order['done'])===2?"печатаем":"отправлен")))."</th>";
		echo "<th class='table-cell'>
			<a href=\"/site/admin/mark?id=" . $order['id'] . "&mark=0\"> принят </a>
			</th>";
		echo "<th class='table-cell'>
			<a href=\"/site/admin/mark?id=" . $order['id'] . "&mark=1\"> согласован </a>
			</th>";
		echo "<th class='table-cell'>
			<a href=\"/site/admin/mark?id=" . $order['id'] . "&mark=2\"> печатаем </a>
			</th>";
		echo "<th class='table-cell'>
			<a href=\"/site/admin/mark?id=" . $order['id'] . "&mark=3\"> отправлен </a>
			</th>";
		echo "<th class='table-cell'>
			<a href=\"/site/admin/delete?id=" . $order['id'] . "\"> Удалить. </a>
			</th>";
	echo "</tr>";
}
echo "</div><br/>";
