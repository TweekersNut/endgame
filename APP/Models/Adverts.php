<?php
namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Adverts{

    private $db;
    private $tbl = 'adverts';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

    public function listAll($area = null){
        if(!is_null($area)){
            $sqlQuery = "select * from {$this->getTableName()} where area = :area and status <> 0";
            $this->db->query($sqlQuery);
            $this->db->bind(':area', strtolower($area));
            return $this->db->resultSet();
        }
        return false;
    }
    
    public function get($id){
        if(is_numeric($id)){
            $sqlQuery = "select * from {$this->getTableName()} where id = :id and status <> 0";
            $this->db->query($sqlQuery);
            $this->db->bind(":id",$id);
            return $this->db->single();
        }
        return false;
    }
    
    public function search($query){
        if ($query) {
            $sqlQuery = "select * from {$this->tbl} where name LIKE '%{$query}%' or (link LIKE '%{$query}%');";
            $this->db->query($sqlQuery);
            return $this->db->resultSet();
        }
        return false;
    }
    
    public function listActive(){
        $sqlQuery = "select * from {$this->getTableName()} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    public function listInActive(){
        $sqlQuery = "select * from {$this->getTableName()} where status = 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

}
