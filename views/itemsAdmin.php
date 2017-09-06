<?php
require_once ROOT . '/models/Items.php';

echo "<table class='admin-item-row table-table'>";
echo "<caption>Items</caption>";
	echo "<tr class='table-row table-header'>";
		echo "<th class='table-cell'>id</th>";
		echo "<th class='table-cell'>description</th>";
		echo "<th class='table-cell'>cost</th>";
		echo "<th class='table-cell'>overlay</th>";
		echo "<th class='table-cell'>name</th>";
		echo "<th class='table-cell'>picture</th>";
		echo "<th class='table-cell'>type</th>";
	echo "</tr>";
foreach (Items::selectAll() as $item) {
	echo "<tr class='table-row'>";
		echo "<th class='table-cell'>".$item['id']."</th>";
		echo "<th class='table-cell'>".$item['description']."</th>";
		echo "<th class='table-cell'>".$item['cost']."</th>";
		echo "<th class='table-cell'>".$item['overlay']."</th>";
		echo "<th class='table-cell'>".$item['name']."</th>";
		echo "<th class='table-cell'>".$item['picture']."</th>";
		echo "<th class='table-cell'>".(intval($item['type'])===0?"simple":(intval($item['type'])===1?"gift":(intval($item['type'])===2?"plaid":"pillow")))."</th>";
	echo "</tr>";
	//echo $_SERVER['REQUEST_URI'];
	//echo "<a href=\"/site/admin/delete?id=" . $item['id'] . "\"> Удалить. </a>";
}
echo "</table><br/>";
