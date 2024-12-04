<?php
// Bước 1: Kết nối CSDL
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tintuc"; // Cập nhật tên cơ sở dữ liệu thành "tintuc"

try {
    // Lấy ID bài viết từ URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Tạo kết nối
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        // Bước 2: Truy vấn để xóa bài viết
        $sql = "DELETE FROM users WHERE id = :id"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Kiểm tra nếu có bản ghi nào bị xóa
        if ($stmt->rowCount() > 0) {
            // Bước 3: Chuyển hướng về trang quản lý bài viết sau khi xóa thành công
            header("Location: http://localhost/th_2/public/index.php?msg=delete_success"); // Thêm thông báo thành công
            exit;
        } else {
            // Nếu không tìm thấy bài viết với ID đó
            header("Location: http://localhost/th_2/public/index.php?msg=delete_fail");
            exit;
        }
    } else {
        // Nếu không có ID, chuyển hướng về trang quản lý bài viết
        header("Location: http://localhost/th_2/public/index.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
} finally {
    // Bước 4: Đóng kết nối
    $conn = null;
}
?>
