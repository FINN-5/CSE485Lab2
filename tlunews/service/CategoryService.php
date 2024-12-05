<?php
require_once APP_ROOT . '/tlunews/config/DBConnection.php';
require_once APP_ROOT . '/tlunews/models/Category.php';
require_once APP_ROOT . '/tlunews/models/News.php';
class CategoryService
{
    public function getAllCategories()
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        }

        // B2. Truy vấn dữ liệu
        $sql = "SELECT * FROM categories";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả trả về
        $categories = [];
        while ($row = $stmt->fetch()) {
            $category = new Category($row['id'], $row['name']);
            $categories[] = $category;
        }
        return $categories;
    }
    public function addCategory($name)
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        $message = '';
        $errors = [];

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        } else {

            if (!empty($name)) {
                try {
                    // B2. Thực hiện truy vấn
                    $sql = "INSERT INTO categories (name) VALUES (:name)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->execute();
                    $message = "Thêm thể loại thành công.";
                } catch (Exception $e) {
                    $errors[] = "Thêm thể loại thất bại.";
                }
            }
        }
        return ['message' => $message, 'errors' => $errors];
    }
    public function updateCategory($id, $name)
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        $message = '';
        $errors = [];

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        } else {
            if (!empty($id) && !empty($name)) {
                try {
                    // B2. Thực hiện truy vấn
                    $sql = "UPDATE categories SET name = :name WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();

                    $message = "Cập nhật thể loại thành công.";
                } catch (Exception $e) {
                    $errors[] = "Cập nhật thể loại thất bại.";
                } finally {
                    $conn = null;
                }
            }
        }
        return ['message' => $message, 'errors' => $errors];
    }
    public function deleteCategory()
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        $message = '';
        $errors = [];

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        } else {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST['id'];
                try {
                    // B2. Thực hiện truy vấn
                    $sql = "DELETE FROM categories WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $message = "Xóa thể loại thành công.";
                    header("Location:");
                } catch (Exception $e) {
                    $errors[] = "Xóa thể loại thất bại.";
                } finally {
                    $conn = null;
                }
            }
        }
        return ['message' => $message, 'errors' => $errors];
    }

    public function getCategoryById($id)
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        $category = null;

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        } else {
            try {
                // B2. Thực hiện truy vấn
                $sql = "SELECT * FROM categories WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch();
                if ($row) {
                    $category = new Category($row['id'], $row['name']);
                }
            } catch (Exception $e) {
                throw new Exception("Không thể lấy dữ liệu từ cơ sở dữ liệu.");
            }
        }
        return $category;
    }
    public function getNewsByCategoryId($id)
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        }

        // B2. Truy vấn dữ liệu
        $sql = "SELECT * FROM news WHERE category_id = :id ORDER BY created_at DESC";;
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        // B3. Xử lý kết quả trả về
        $news = [];
        while ($row = $stmt->fetch()) {
            $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
            $news[] = $new;
        }
        return $news;
    }
    public function getNews()
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        }

        // B2. Truy vấn dữ liệu
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả trả về
        $news = [];
        while ($row = $stmt->fetch()) {
            $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
            $news[] = $new;
        }
        return $news;
    }
}
