<?php

class DefaultController {
	function actionIndex() {
		include_once ROOT . '/views/index.php';
		return true;
	}
	function actionFeedback() {
		$itemId = $_GET['id'];
		include_once ROOT . '/views/feedback.php';
		return true;
	}
	function actionPlaid() {
		include_once ROOT . '/views/plaid.php';
		return true;
	}
}
