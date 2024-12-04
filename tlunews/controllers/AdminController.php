


<?php
try {
    $conn = new PDO(dsn: "mysql:host=localhost; dbname=tintuc", username: "root", password: "");
    $sql = "SELECT id, username, password, role FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchALL();
} catch (PDOException $e) {
    echo "Có lỗi xra: " . $e->getMessage();
}
$conn = null;

// Lấy id từ URL
$id = $_GET['id'];
$user = $users[$id];

// Xử lý cập nhật dữ liệu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Cập nhật dữ liệu
    $users[$id]['username'] = $username;
    $users[$id]['password'] = $password;
    $users[$id]['role'] = $role;

    // Lưu lại dữ liệu vào file
    file_put_contents('data.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n");

    // Chuyển hướng về trang danh sách
    header('Location: D:\C_Laragon\laragon\www\tlunews\models\User.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
</head>
<body>
    <h1>Edit user</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Username: </label><br>
        <input type="text" id="username" name="username" value="<?= $user['username']; ?>" required><br><br>

        <label for="password">Password: </label><br>
        <input type="text" id="password" name="password" value="<?= $user['password']; ?>" required><br><br>

        <label for="role">Role: </label><br>
        <input type="text" id="role" name="role" value="<?= $user['role']; ?>" required><br><br>


        

        <button type="submit">Update</button>
    </form>
</body>
</html>
