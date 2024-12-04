<?php



//4 bước:

//b1: kết nối thành công vào DB server
try {
    $conn = new PDO(dsn: "mysql:host=localhost; dbname=tintuc", username: "root", password: "");

    // Xác định số bài viết mỗi trang
    $records_per_page = 10;

    // Lấy trang hiện tại từ tham số GET (mặc định là 1 nếu không có tham số)
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $current_page = max(1, $current_page); // Đảm bảo trang >= 1

    // Tính toán OFFSET
    $offset = ($current_page - 1) * $records_per_page;

    // Đếm tổng số bài viết
    $total_sql = "SELECT COUNT(*) FROM users";
    $total_stmt = $conn->query($total_sql);
    $total_records = $total_stmt->fetchColumn();

    // Tính tổng số trang
    $total_pages = ceil($total_records / $records_per_page);

    //b2: thực thi câu truy vấn(SELECT | INSERT, UPDATE, DELETE)
    $sql = "SELECT id, username, password, role FROM users LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql); // Chưa thực thi , gửi cu phap lệnh tới MySQl, chống lỗi sql injection
    $stmt->bindParam(':limit', $records_per_page, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute(); // thực thi câu lệnh sQL dã gửi đến đi
    //b3: xử lý kết quả trả về (SELECT: mảng các bản ghi | INSERT, UPDATE, DELETE: số bản ghi)
    $users = $stmt->fetchALL();
} catch (PDOException $e) {
    echo "Có lỗi xra: " . $e->getMessage();
}
//b4: đóng kn
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <h2 class="text-center">User management</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Thêm</button>
        <table class="table table-bordered">
            <thead thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">Here</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($user['id']) ?></th>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['password']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= htmlspecialchars($user['id']); ?>">Sửa</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($user['id']); ?>">Xóa</button>
                        </td>

                        <!-- Modal Sửa -->
                        <div class="modal fade" id="editModal<?= htmlspecialchars($user['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= htmlspecialchars($user['id']); ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= htmlspecialchars($user['id']); ?>">Edit user</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Exit">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="D:\C_Laragon\laragon\www\tlunews\controllers\AdminController.php?id=<?= htmlspecialchars($user['id']); ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="name">Username</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['username']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password: </label>
                                                <input class="form-control" type="text" id="password" name="password" value="<?= $user['password']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role: </label><br>
                                                <input class="form-control" type="text" id="role" name="role" value="<?= $user['role']; ?>" required><br><br>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                    <?php endforeach ?>
                    </tr>

            </tbody>
        </table>

        <nav aria-label="..." class="d-flex justify-content-center">
            <ul class="pagination">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $current_page - 1 ?>">Previous</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                    <li class="page-item <?= $page == $current_page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $current_page + 1 ?>">Next</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>