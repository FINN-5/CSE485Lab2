<?php
class News
{
    private $id;
    private $content;
    private $image;
    private $created_at;
    private $category_id;
    public function __construct($id, $content, $image, $created_at, $category_id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->category_id = $category_id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
}
