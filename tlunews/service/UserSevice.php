<?php
require_once APP_ROOT . '/tlunews/models/User.php';

class UserService
{
    public function getAllUsers()
    {
        try {
            // B1. Kết nối database
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();

            if ($conn === null) {
                throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
            }

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


            // B2. Truy vấn dữ liệu
            $sql = "SELECT * FROM users LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':limit', $records_per_page, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute(); // thực thi câu lệnh sQL dã gửi đến đi
            // B3. Xử lý kết quả trả về
            $users = [];
            while ($row = $stmt->fetch()) {
                $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                $users[] = $user;
            }

            return [
                'users' => $users,
                'current_page' => $current_page,
                'total_pages' => $total_pages
            ];
        } catch (PDOException $e) {
            // Xử lý lỗi kết nối hoặc lỗi truy vấn
            echo "Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage();
            return [];
        } catch (Exception $e) {
            // Xử lý lỗi chung
            echo "Lỗi: " . $e->getMessage();
            return [];
        } finally {
            // B4. Đóng kết nối
            $conn = null;
        }
    }
}
