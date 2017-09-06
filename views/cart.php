<?php
if (isset($itemsToShow) && $itemsToShow !== null) {
	foreach ($itemsToShow as $item) {
		echo "<div class='row order-row' item-number='" . $item['itemNumber'] . "'>
				<div class='col-md-2'>
		            <img src='" . $item[0]['picture'] . "' alt='Инстаграм' id='order-pic'>
		        </div>
		        <div class='col-md-3 order-element'>
		          <div class='order-content'>" . $item[0]['name'] . "</div>
		        </div>
		        <div class='col-md-2 order-element'>
		          <div class='order-content'>" . $item[0]['cost'] . "</div>
		        </div>
		        <div class='col-md-2 order-element'>
		          <div class='order-content'>10</div>
		        </div>
		        <div class='col-md-2 order-element'>
		          <div class='order-content'>290</div>
		        </div>
		        <div class='col-md-1 order-element'>
		          <div class='order-delete'>
		            <img src='assets/images/delete-button.png'>            
		          </div>
		        </div>
		    </div>";
	}
} else {
	echo "
	<div id='my-order'>Мой заказ</div>

	<div class='container-fluid'>
	    <div class='row order-head'>
	        <div class='col-md-2'>Фото</div>
	        <div class='col-md-3'>Наименование</div>
	        <div class='col-md-2'>Цена</div>
	        <div class='col-md-2'>Кол-во</div>
	        <div class='col-md-2'>Сумма</div>
	    </div>
	</div>
	<div class='container-fluid order'></div>";
	echo "
	<div class='container-fluid'>
		<div class='row order-row'>
			<div class='col-md-3 col-md-offset-2'>
				<div class='order-form'>
					<input type='text' id='order-name' placeholder='Имя'>
					<input type='text' id='order-address' placeholder='Адрес'>
					<input type='text' id='order-phone' placeholder='Телефон'>
					<input type='text' id='order-email' placeholder='Почта'>
					<input type='text' id='order-description' placeholder='Описание'>
					<div class='btn' id='order-buy'>Купить</div>
				</div>
			</div>
		</div>
	</div>
	";
}