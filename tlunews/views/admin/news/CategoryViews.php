<?php

$message = '';
$errors = [];
//Phân trang
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPages = ceil(count($categories) / $itemsPerPage);
$currentPageItems = array_slice($categories, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=10">
    <title>Thể loại tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <?php if ($message): ?>
            <div class="container">
                <div class="alert alert-success  alert-dismissible" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                    <button class="btn-close" aria-label="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div class="container">
                <div class="alert alert-danger  alert-dismissible" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                    <button class="btn-close" aria-label="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>
        <h3 class="text-center text-uppercase text-success my-3">Thể Loại Tin Tức</h3>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?= DOMAIN . '/public/index.php' ?>?X=<?= urlencode('add'); ?>" class='btn btn-success'><i class="bi bi-plus-circle"></i> Thêm thể loại</a>
            <a href="../logout.php" class='btn btn-danger'>Đăng xuất</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên thể loại</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currentPageItems as $categori): ?>
                    <tr>
                        <td><?= htmlspecialchars($categori->getID()); ?></td>
                        <td><?= htmlspecialchars($categori->getName()); ?></td>

                        <td>

                            <a href="<?= DOMAIN . '/public/index.php' ?>?id=<?= urlencode($categori->getID()); ?>" class="btn btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-id="<?= htmlspecialchars($categori->getID()); ?>">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link text-success" href="?page=<?= $currentPage - 1 ?>">Trang trước</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link text-success" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link text-success" href="?page=<?= $currentPage + 1 ?>">Trang tiếp theo</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= DOMAIN . '/public/index.php?action=delete'; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="delete-id">
                        <p>Bạn có chắc chắn muốn xóa thể loại tin tức này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Gắn ID vào modal khi nhấn nút xóa
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button đã kích hoạt modal
            const id = button.getAttribute('data-id'); // Lấy ID từ button
            const inputId = document.getElementById('delete-id');
            inputId.value = id; // Gắn ID vào input hidden
        });
    </script>
</body>


</html>