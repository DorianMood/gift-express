<?php

require_once ROOT . '/models/Items.php';

$items = Items::selectAll();
if (isset($_GET['id'])) {
	foreach ($items as $i)
		if ($i['id'] === $_GET['id'])
			$item = $i;
	if (intval($item['type']) === 1) { // type = 1 : GIFT
		include ROOT . '/views/gift.php';
	} elseif (intval($item['type']) === 2) { // type = 2 : PLAID
		include ROOT . '/views/plaid.php';
	} elseif (intval($item['type']) === 3) { // type = 3 : PILLOW
		include ROOT . '/views/pillow.php';
	} else {
		echo
			"<div class='row'>
				<div class='col-md-4 col-md-offset-1 product'>
					<img src='" . $item['picture'] . "' alt='" . $item['overlay'] . "' class='' id='selected-picture'>
				</div>

				<div class='col-md-5 col-md-offset-1'>
					<h1><b id='selected-title'>" . $item['name'] . "</b></h1>
					<h3><b id='selected-price'>Цена : " . $item['cost'] . "</b></h3>
					<h3 id='selected-description'>" . $item['description'] . "</h3>
					<p></p>

					<div class='btn' id='cart-item-add'>Хочу!</div>
				</div>

			</div>";
	}
}
else {
	$item = $items[0];
	echo
		"<div class='container-fluid product-content'>
			<div class='row'>
				<div class='col-md-4 col-md-offset-1 product'>
					<img src='" . $item['picture'] . "' alt='" . $item['overlay'] . "' class='' id='selected-picture'>
				</div>

				<div class='col-md-5 col-md-offset-1'>
					<h1><b id='selected-title'>" . $item['name'] . "</b></h1>
					<h3><b id='selected-price'>Цена : " . $item['cost'] . "</b></h3>
					<h3 id='selected-description'>" . $item['description'] . "</h3>
					<p></p>

					<div class='btn' id='cart-item-add'>Хочу!</div>
				</div>

			</div>
		</div>";
}

echo "<script>$(document).ready( function () {
		selected = " . $item['id'] . ";
	});</script>";