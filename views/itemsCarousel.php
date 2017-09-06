<?php

require_once ROOT . '/models/Items.php';

$items = Items::selectAll();


echo "<div class='owl-carousel slide'>";
foreach ($items as $item) {
	echo
	"<div class='button' id='carousel-item'>
        <img class='center-block pic' src='" . $item['picture'] . "' alt=''>
        <div class='overlay' item_id='" . $item['id'] . "'>
            <div class='text'>" . $item['overlay'] . "</div>
        </div>
    </div>";
}
echo "</div>";