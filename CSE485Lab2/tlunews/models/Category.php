<?php
class Category
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function DBConnection()
    {;


        try {
            $conn = new PDO("mysql:host=localhost;dbname=tintuc", 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            $conn = null;
        }
        return $conn;
    }



    public static function all()
    {
        $ds = [];

        $conn = (new self(null, null))->DBConnection();
        $req = $conn->query("SELECT * FROM categories");
        foreach ($req->fetchAll() as $row) {
            $ds[] = new Category($row['id'], $row['name']);
        }
        return $ds;
    }
}
