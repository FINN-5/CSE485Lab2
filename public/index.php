<?php
require_once dirname(__FILE__, 2) . '/tlunews/config/config.php';
require_once APP_ROOT . '/tlunews/config/DBConnection.php';

require_once APP_ROOT . '/tlunews/controllers/AdminController.php';




$userController = new AdminController();
$userController->index();
?>
