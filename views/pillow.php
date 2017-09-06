<?php
echo "
<div class=\"container-fluid\">
	<div class=\"row\">
		<div class=\"col-md-5 col-md-offset-1\">
			<div class=\"pillow-div\" id=\"product\">
				<table class=\"pillow-table\">";
					for ($i = 0; $i < 3; $i++) {
						echo "<tr>";
						for ($j = 0; $j < 3;$j++)
							echo "<td class=\"pillow-td\" number=" . (3 * $i + $j + 1) . "><div class=\"pillow-preview-container\"></div></td>";
						echo "</tr>";
					}
					echo "
				</table>
			</div>
			<br>
			<div class='btn' id='clear-pillow-table'>Очистить</div>
		</div>" . include(ROOT . '/views/redactor.php');
echo "
	</div>
</div>
<script src='assets/js/pillow.js'></script>";