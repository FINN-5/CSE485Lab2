<?php
require_once 'D:\Laragon\laragon\www\New folder\CSE485Lab2\tlunews\controllers\NewsController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NewsController();
    $controller->create($_POST);
    $message = "add_success";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm Tin Tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Thêm Tin Tức</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <input type="number" class="form-control" id="category_id" name="category_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>
