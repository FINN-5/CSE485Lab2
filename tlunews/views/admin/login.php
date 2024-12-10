<?php
session_start();

// Kiểm tra nếu người dùng nhấn nút đăng nhập
if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Tạo kết nối tới cơ sở dữ liệu
    $db = new DBConnection();
    $conn = $db->getConnection();

    if ($conn) {
        try {
            // Truy vấn người dùng theo email
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra thông tin người dùng
            if ($user && password_verify($password, $user['password'])) {
                // Lưu thông tin vào session
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Chuyển hướng tới dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Email hoặc mật khẩu không đúng!";
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
        <label for="email">Email: </label>
        <input type="text" name="email" placeholder="Email" required>
        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>
