<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class = "container">
        <h2 class="text-center text-uppercase text-primary">Quản lý người dùng</h2>
        <a href="<?= DOMAIN.'/tlunews/views/admin/user/add.php'?>" class="btn btn-primary">Thêm</a>
        <table class ="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã người dùng</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Mật khẩu</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins['users'] as $user) : ?>
                    <tr>
                        <td><?php echo $user->getId(); ?></td>
                        <td><?php echo $user->getUsername(); ?></td>
                        <td><?php echo $user->getPassword(); ?></td>
                        <td><?php echo $user->getRole(); ?></td>
                        <td>
                            <a href="<?= DOMAIN . '/tlunews/views/admin/user/edit.php?id=' . $user->getId() ?>"><i class="bi bi-pencil"></i></a>
                            <a href="<?= DOMAIN . '/tlunews/views/admin/user/delete.php?id=' . $user->getId() ?>"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <nav aria-label="..." class="d-flex justify-content-center">
            <ul class="pagination">
                <?php if ($admins['current_page'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $admins['current_page'] - 1 ?>">Trước</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link">Trước</a>
                    </li>
                <?php endif; ?>

                <?php for ($page = 1; $page <= $admins['total_pages']; $page++): ?>
                    <li class="page-item <?= $page == $admins['current_page'] ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($admins['current_page'] < $admins['total_pages']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $admins['current_page'] + 1 ?>">Sau</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link">Sau</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>