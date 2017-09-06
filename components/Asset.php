<?php

echo "<title>Название</title>";
foreach (include_once(ASSETS) as $asset) {
	if (substr($asset, -3) === 'css') {
		echo "<link rel=\"stylesheet\" href=\"".(substr($asset,0,4)==='http'?"":"/site/"."assets/")."$asset\">";
	} elseif (substr($asset, -2) === 'js') {
		echo "<script type=\"text/javascript\" src=\"".(substr($asset,0,4)==='http'?"":"/site/"."assets/")."$asset\"></script>";
	}
}