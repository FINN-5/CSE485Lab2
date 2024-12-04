<?php
require_once('../tlunews/config/config.php');
require_once APP_ROOT . '/tlunews/config/DBConnection.php';

require_once APP_ROOT . '/tlunews/service/CategoryService.php';


$ca = new CategoryService();
$categories = $ca->getAllCategories();

echo "<pre>";
print_r($categories);
echo "</pre>";
