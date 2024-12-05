<?php
require_once APP_ROOT . '/tlunews/service/CategoryService.php';
class HomeController
{
    public function index()
    {
        $categoryService = new CategoryService();
        $category = $categoryService->getAllCategories();
        $ds_news = $categoryService->getNews();
        //Render view
        require_once APP_ROOT . '/tlunews/views/home/index.php';
    }
    public function Category()
    {
        $categoryService = new CategoryService();



        // Nếu là POST request (xử lý thêm hoặc sửa)
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;

            if ($id) {
                // Cập nhật thể loại
                $result = $categoryService->updateCategory($id, $name);
            } elseif ($name) {
                // Thêm thể loại
                $result = $categoryService->addCategory($name);
            }

            $message = $result['message'];
            $errors = $result['errors'];

            // Lấy danh sách thể loại để render lại
            $categories = $categoryService->getAllCategories();
            require_once APP_ROOT . '/tlunews/views/admin/news/CategoryViews.php';
        } else {
            // Nếu là GET request (hiển thị form hoặc danh sách)
            $id = $_GET['id'] ?? null;
            $X = $_GET['X'] ?? null;
            if ($id) {
                // Lấy thông tin thể loại để chỉnh sửa
                $category = $categoryService->getCategoryById($id);
                require_once APP_ROOT . '/tlunews/views/admin/news/add_editCategory.php';
            } else
                if ($X) {
                //thêm hiển thị danh sách thể loại
                require_once APP_ROOT . '/tlunews/views/admin/news/add_editCategory.php';
            } else {
                // Hiển thị danh sách thể loại
                $categories = $categoryService->getAllCategories();
                require_once APP_ROOT . '/tlunews/views/admin/news/CategoryViews.php';
            }
        }
    }
}
