<?php

namespace APP\Models\Blog;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;
use APP\Models\Blog\Category as Cat;
use APP\Models\Blog\Genre as Gen;
use APP\Models\Blog\Platform as Plat;

class Posts {

    private $db;
    private $tbl = 'blog_posts';

    use CRUD;

    function __construct() {
        $this->db = new db;
    }

    public function listAllByCat($cat = null) {
        if (is_numeric($cat)) {
            $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.cat = :cat and {$this->getTableName()}.status <> 0";
            $this->db->query($sqlQuery);
            $this->db->bind(":cat", $cat);
            return $this->db->resultSet();
        }
        return 0;
    }

    public function getAllAdmin() {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            INNER JOIN users on {$this->getTableName()}.user = users.id";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function getFeaturePosts() {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.featured <> 0 and {$this->getTableName()}.status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function getLatest($limit = 5) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.status <> 0 order by {$this->getTableName()}.id DESC";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function getFeaturedPosts($cat = null) {
        if (is_numeric($cat)) {
            $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.cat = :cat and {$this->getTableName()}.featured <> 0 and {$this->getTableName()}.status <> 0";
            $this->db->query($sqlQuery);
            $this->db->bind(":cat", $cat);
            return $this->db->resultSet();
        }
        return 0;
    }

    public function getTrendingPosts($limit = 5) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            order by RAND() limit " . $limit;
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function getByID($id) {
        if (is_numeric($id)) {
            $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.id = :id";
            $this->db->query($sqlQuery);
            $this->db->bind(":id", $id);
            return $this->db->single();
        }
        return false;
    }

    public function getAll() {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.status <> 0 ";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function getByGenre($genName) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where " . (new Gen)->getTableName() . ".name = :gen";
        $this->db->query($sqlQuery);
        $this->db->bind(":gen", $genName);
        return $this->db->resultSet();
    }

    public function getByPlatform($platform) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where " . (new Plat)->getTableName() . ".name = :plat";
        $this->db->query($sqlQuery);
        $this->db->bind(":plat", $platform);
        return $this->db->resultSet();
    }

    public function getByLetter($letter) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.title like '%{$letter}%'";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function search($query) {
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            where {$this->getTableName()}.title like '%{$query}%' or " . (new Gen)->getTableName() . ".name like '%{$query}%' or " . (new Plat)->getTableName() . ".name like '%{$query}%' or " . (new Cat)->getTableName() . ".name like '%{$query}%' ";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    public function getAllPublished(){
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            INNER JOIN users on {$this->getTableName()}.user = users.id where {$this->getTableName()}.status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    public function getAllDraft(){
        $sqlQuery = "select *," . (new Cat)->getTableName() . ".desc as Cat_Desc ," . (new Cat)->getTableName() . ".status as Cat_Status ," . (new Cat)->getTableName() . ".name as Cat_Name ," . (new Cat)->getTableName() . ".id as Cat_ID ,{$this->getTableName()}.status as status,{$this->getTableName()}.id as id," . (new Gen)->getTableName() . ".status as Gen_Status," . (new Gen)->getTableName() . ".id as Gen_ID," . (new Gen)->getTableName() . ".name as Gen_Name," . (new Plat)->getTableName() . ".name as Plat_Name," . (new Plat)->getTableName() . ".id as Plat_ID," . (new Plat)->getTableName() . ".status as Plat_Status from {$this->getTableName()} 
            INNER JOIN " . (new Cat)->getTableName() . " on {$this->getTableName()}.cat = " . (new Cat)->getTableName() . ".id 
            INNER JOIN " . (new Plat)->getTableName() . " on {$this->getTableName()}.platform = " . (new Plat)->getTableName() . ".id
            INNER JOIN " . (new Gen)->getTableName() . " on {$this->getTableName()}.genre = " . (new Gen)->getTableName() . ".id
            INNER JOIN users on {$this->getTableName()}.user = users.id where {$this->getTableName()}.status = 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

}
