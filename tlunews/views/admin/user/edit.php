<?php
// Kết nối CSDL
$user_id = isset($_GET['id']) ? $_GET['id'] : 0;

try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=localhost;dbname=tintuc", "root", "");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cập nhật thông tin người dùng khi form được gửi
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Chuyển đổi vai trò thành số: admin = 1, user = 0
        $role = $_POST['role'] == 'admin' ? 1 : 0;

        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $sql = "UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_INT);  // Lưu dưới dạng số
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Sau khi cập nhật thành công, chuyển hướng về trang quản lý người dùng
        header("Location: http://localhost/th_2/public/index.php");
        exit; // Dừng mọi xử lý sau khi chuyển hướng
    } else {
        // Truy vấn để lấy thông tin người dùng
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "Người dùng không tồn tại.";
            exit;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Người Dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-center">SỬA THÔNG TIN NGƯỜI DÙNG</h1>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Vai trò</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="" disabled>Chọn vai trò</option>
                    <option value="admin" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
