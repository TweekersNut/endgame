<?php

namespace APP\Models\Blog;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

use APP\Models\Blog\Genre as Gen;
use APP\Models\Blog\Platform as Plat;
use APP\Models\Blog\Posts as Posts;

class Category{
    private $db;
    private $tbl = 'blog_cat';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

    public function exists($cat){
        if(is_numeric($cat)){
            $check = $cat;
            $sqlQuery = "select * from {$this->tbl} where id = :cat";
        }else{
            $check = ucfirst(strtolower($cat));
            $sqlQuery = "select * from {$this->tbl} where name = :cat";
        }
        $this->db->query($sqlQuery);
        $this->db->bind(":cat", $check);
        $this->db->execute();
        if($this->db->rowCount() > 0){
            return $this->db->single()->id;
        }
        return false;
    }
    

}