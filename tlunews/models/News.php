<?php
class NewsModel
{
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối CSDL thất bại: " . $e->getMessage());
        }
    }

    public function getAllWithPagination($page, $limit)
    {
        // Tính toán offset
        $offset = ($page - 1) * $limit;

        // Truy vấn lấy bài viết
        $stmt = $this->conn->prepare("SELECT * FROM news order by created_at desc LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Truy vấn để lấy tổng số bản ghi
        $stmtCount = $this->conn->prepare("SELECT COUNT(*) FROM news");
        $stmtCount->execute();
        $totalCount = $stmtCount->fetchColumn();

        // Tính toán tổng số trang
        $totalPages = ceil($totalCount / $limit);

        // Trả về dữ liệu bao gồm cả thông tin phân trang
        return [
            'items' => $items,
            'total_pages' => $totalPages
        ];
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $image, $category_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO news (title, content, image, category_id, created_at) VALUES (:title, :content, :image, :category_id, NOW())");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute();
    }

    public function update($id, $title, $content, $image, $category_id)
    {
        $stmt = $this->conn->prepare("UPDATE news SET title = :title, content = :content, image = :image, category_id = :category_id WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
