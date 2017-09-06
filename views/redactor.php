<?php
return "
<div class='col-md-4 col-md-offset-1'>
	<div class='gift-div'>
		<div class='image-container'>
			<img class='picture-redactor-image' id='image' src='assets/images/example.jpg' />
		</div>
		<div class='gift-input'>
			<input type='text' placeholder='Подпись' id='refresh-polaroid' />
		</div>
		<div class='btn' id='select-polaroid-picture'>
			Обновить фото
		</div>
	</div>
	<br>
	<div class='price-redactor'>15$</div>
	<div class='btn' id='add-to-cart-redactor'>Хочу!</div>
	</div>
</div>
<script src='assets/js/polaroid.js'></script>
<script>initRedactor();var text = undefined;</script>";