<?php
require_once 'D:\Laragon\laragon\www\New folder\CSE485Lab2\tlunews\controllers\NewsController.php';

$controller = new NewsController();

// Xử lý xóa bản ghi
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $controller->delete($id); // Gọi phương thức xóa từ controller
    $message = "delete_success";
}

// Xác định trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Lấy dữ liệu phân trang
$pagination = $controller->list($page);
$articles = $pagination['items'] ?? [];
$totalPages = $pagination['total_pages'] ?? 1;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lý tin tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Danh sách tin tức</h1>


        <?php if (isset($message)): ?>
            <script>
                <?php if ($message == 'delete_success'): ?>
                    alert("Xóa bản ghi thành công!");
                <?php elseif ($message == 'add_success'): ?>
                    alert("Thêm bản ghi thành công!");
                <?php elseif ($message == 'update_success'): ?>
                    alert("Cập nhật bản ghi thành công!");
                <?php endif; ?>
            </script>
        <?php endif; ?>

        <?php if (isset($message)): ?>
            <div class="alert alert-success" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <div class="text-end mb-3">
            <a href="add.php" class="btn btn-success">Thêm bản ghi</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Hình ảnh</th>
                    <th>Loại danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($articles) > 0): ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?= $article['id'] ?></td>
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td><?= htmlspecialchars($article['content']) ?></td>
                            <td><img src="<?= htmlspecialchars($article['image']) ?>" alt="Hình ảnh" width="100"></td>
                            <td><?= $article['category_id'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $article['id'] ?>" class="btn btn-primary">Sửa</a>
                                <!-- Form Xóa -->
                                <form method="POST" action="index.php" style="display:inline">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Xóa bản ghi này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</body>

</html>