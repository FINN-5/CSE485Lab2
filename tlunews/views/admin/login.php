<?php
require_once 'D:/C_Laragon/laragon/www/th_2/tlunews/config/config.php';
require_once 'D:/C_Laragon/laragon/www/th_2/tlunews/config/DBConnection.php';
session_start();

// Kiểm tra nếu người dùng nhấn nút đăng nhập
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Tạo kết nối tới cơ sở dữ liệu
    $db = new DBConnection();
    $conn = $db->getConnection();

    if ($conn) {
        try {
            // Truy vấn người dùng theo email
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra thông tin người dùng
            if ($user && $password === $user['password']) {
                // Lưu thông tin vào session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Chuyển hướng
                header("Location:" . DOMAIN . "/public/index.php");
                exit;
            } else {
                $error = "Username/mật khẩu không đúng!";
            }
        } catch (PDOException $e) {
            $error = "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
        }
    } else {
        $error = "Không thể kết nối tới cơ sở dữ liệu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="username">Tên người dùng: </label>
        <input type="text" name="username" placeholder="Tên người dùng" required>
        <label for="password">Mật khẩu: </label>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit" name="login">Đăng nhập</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>


