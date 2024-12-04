<?php


$message = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Tạo kết nối
        $conn = new PDO("mysql:host=localhost; dbname=tintuc", "root", "");

        // Thiết lập chế độ báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Nhận dữ liệu từ form
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $role = trim($_POST['role']);

        if ($role == 'admin') {
            $role = 1;
        } elseif ($role == 'user') {
            $role = 0;
        }

        // Kiểm tra các trường
        if (empty($username)) {
            $errors[] = "Tên người dùng không được để trống";
        }
        if (empty($password)) {
            $errors[] = "Mật khẩu không được để trống";
        }

        // Nếu không có lỗi, thực hiện thêm dữ liệu vào CSDL
        if (empty($errors)) {
            $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);

            $stmt->execute();
            $message = "Người dùng đã được thêm thành công!";

            // Chuyển hướng về trang quản lý người dùng sau khi thêm
            header("Location: http://localhost/th_2/public/index.php");
            exit(); // Dừng script để tránh việc mã tiếp tục thực thi
        }
    } catch (PDOException $e) {
        $message = "Lỗi kết nối hoặc truy vấn: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Thêm Người Dùng</title>
</head>

<body>
    <div class="container py-4">
        <h1 class="text-center text-primary mb-4">Thêm Người Dùng Mới</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="" class="bg-light p-4 shadow rounded">
            <div class="form-group row mb-3">
                <label for="username" class="col-sm-2 col-form-label"><strong>Tên người dùng:</strong></label>
                <div class="col-sm-10">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nhập tên người dùng" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="password" class="col-sm-2 col-form-label"><strong>Mật khẩu:</strong></label>
                <div class="col-sm-10">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="role" class="col-sm-2 col-form-label"><strong>Vai trò:</strong></label>
                <div class="col-sm-10">
                    <select id="role" name="role" class="form-control" required>
                        <option value="" disabled selected>Chọn vai trò</option>
                        <option value="admin" <?php echo isset($role) && $role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?php echo isset($role) && $role == 'user' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="dashboard.php" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Trở lại</a>
                <input type="submit" value="Thêm người dùng" class="btn btn-success mt-3 ms-3">
            </div>
        </form>
    </div>
</body>

</html>