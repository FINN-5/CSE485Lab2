<?php
require_once 'D:\Laragon\laragon\www\CSE485Lab2\tlunews\models\News.php';

class NewsController
{
    private $model;

    
    public function __construct()
    {
        $this->model = new NewsModel("localhost", "tintuc", "root", "");
    }

    public function list()
    {
        return $this->model->getAll();
    }

    public function view($id)
    {
        return $this->model->getById($id);
    }

    public function create($data)
    {
        return $this->model->create($data['title'], $data['content'], $data['image'], $data['category_id']);
    }

    public function update($id, $data)
    {
        return $this->model->update($id, $data['title'], $data['content'], $data['image'], $data['category_id']);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
?>
