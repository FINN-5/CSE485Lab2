<?php
require_once 'D:\Laragon\laragon\www\New folder\CSE485Lab2\tlunews\models\News.php';

class NewsController
{
    private $model;
    
    public function __construct()
    {
        $this->model = new NewsModel("localhost", "tintuc", "root", "");
    }

    public function list($page = 1)
    {
        $limit = 5; // Số bản ghi trên mỗi trang
        return $this->model->getAllWithPagination($page, $limit);
    }

    public function view($id)
    {
        return $this->model->getById($id);
    }

    public function create($data)
    {
        $this->model->create($data['title'], $data['content'], $data['image'], $data['category_id']);
        header('Location: index.php');
        exit;
    }

    public function update($id, $data)
    {
        $this->model->update($id, $data['title'], $data['content'], $data['image'], $data['category_id']);
        header('Location: index.php');
        exit;
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: index.php');
        exit;
    }
}
