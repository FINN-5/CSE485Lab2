<?php
require_once 'D:\Laragon\laragon\www\CSE485Lab2\tlunews\controllers\NewsController.php';

$controller = new NewsController();

// Số bản ghi trên mỗi trang
$records_per_page = 5;

// Tổng số bản ghi
$total_records = count($controller->list());

// Tổng số trang
$total_pages = ceil($total_records / $records_per_page);

// Trang hiện tại
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages));

// Lấy dữ liệu phân trang
$offset = ($current_page - 1) * $records_per_page;
$articles = $controller->list($offset, $records_per_page);
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
        <div class="text-end mb-3">
            <button class="btn btn-success" onclick="showForm('create')">Thêm bản ghi</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Hình ảnh</th>
                    <th>Ngày tạo </th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article['id'] ?></td>
                        <td><?= $article['title'] ?></td>
                        <td><?= $article['content'] ?></td>
                        <td><img src="<?= $article['image'] ?>" alt="Hình ảnh" width="100"></td>
                        <td><?= $article['created_at'] ?></td>
                        <td>
                            <button class="btn btn-primary" onclick="showForm('update', <?= htmlspecialchars(json_encode($article)) ?>)">Sửa</button>
                            <form method="POST" style="display:inline">
                                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa bản ghi này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- Modal Popup -->
    <div class="modal" id="formModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" onclick="hideForm()"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="formId">
                        <input type="hidden" name="action" id="formAction">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <input type="number" class="form-control" id="category_id" name="category_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button type="button" class="btn btn-secondary" onclick="hideForm()">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showForm(action, data = {}) {
            document.getElementById('modalTitle').innerText = action === 'create' ? 'Thêm bản ghi' : 'Sửa bản ghi';
            document.getElementById('formAction').value = action;
            document.getElementById('formId').value = data.id || '';
            document.getElementById('title').value = data.title || '';
            document.getElementById('content').value = data.content || '';
            document.getElementById('image').value = data.image || '';
            document.getElementById('category_id').value = data.category_id || '';
            document.getElementById('formModal').style.display = 'block';
            document.getElementById('formModal').classList.add('show');
        }

        function hideForm() {
            document.getElementById('formModal').classList.remove('show');
            document.getElementById('formModal').style.display = 'none';
        }
    </script>
</body>

</html>
