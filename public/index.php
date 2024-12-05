<?php
require_once('../tlunews/config/config.php');
require_once APP_ROOT . '/tlunews/config/DBConnection.php';
require_once APP_ROOT . '/tlunews/service/CategoryService.php';


require_once APP_ROOT . '/tlunews/controllers/HomeController.php';
$homeController = new HomeController();
//$homeController->index();

$action = $_GET['action'] ?? 'index';

if ($action === 'categories') {
    $homeController->Category();
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    $categoryService = new CategoryService();
    $categoryService->deleteCategory($id);
    $homeController->Category();
    exit;
}
$homeController->Category();
