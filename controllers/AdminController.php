<?php
require_once ROOT . '/models/Orders.php';

class AdminController {

	function actionIndex() {
		include(ROOT.'/views/admin.php');
		return true;
	}

	function actionOrders() {
		if (isset($_GET['mark']))
			Orders::markOrder($_GET['mark']);
		elseif (isset($_GET['delete']))
			Orders::deleteOrder($_GET['delete']);
		return true;
	}
	function actionMark() {
		if (isset($_GET['id']) && isset($_GET['mark'])) {
			Orders::markOrder($_GET['id'], $_GET['mark']);
		}
		include(ROOT.'/views/admin.php');

		return true;
	}
	function actionUnmark() {
		if (isset($_GET['id'])) {
			Orders::unmarkOrder($_GET['id']);
		}
		include(ROOT.'/views/admin.php');

		return true;
	}
	function actionDelete() {
		if (isset($_GET['id'])) {
			Orders::deleteOrder($_GET['id']);
		}
		include(ROOT.'/views/admin.php');

		return true;
	}
	function actionGetOrders() {
		echo json_encode(Orders::selectAll());
		return true;
	}
}
