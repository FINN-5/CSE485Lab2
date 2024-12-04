<?php
require_once APP_ROOT . '/tlunews/service/CategoryService.php';
class HomeController
{
    public function index()
    {
        $categoryService = new CategoryService();
        $category = $categoryService->getAllCategories();
        
        //Render view
        require_once APP_ROOT . '/tlunews/views/home/index.php';
    }
}