<?php
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
    public function getCategoryById($id)
    {
        // B1. Kết nối database
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new Exception("Không thể kết nối tới cơ sở dữ liệu.");
        }

        // B2. Truy vấn dữ liệu
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        // B3. Xử lý kết quả trả về
        $row = $stmt->fetch();
        if ($row) {
            $category = new Category($row['id'], $row['name'], $row['description']);
            return $category;
        }
        return null;
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
            $new = new News($row['id'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
            $news[] = $new;
        }
        return $news;
    }
}
