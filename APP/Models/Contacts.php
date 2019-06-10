<?php
namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Contacts{

    private $db;
    private $tbl = 'contact';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

    public function get($id){
        if(is_int($id)){
            $sqlQuery = "select * from {$this->tbl} where id = :id";
            $this->db->query($sqlQuery);
            $this->db->bind(':id', $id);
            return $this->db->single();
        }
        return false;
    }
    
    public function activeCount(){
        $sqlQuery = "select count(*) as count from {$this->tbl} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }
    
    public function inactiveCount(){
        $sqlQuery = "select count(*) as count from {$this->tbl} where status = 0";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }
    
    public function searchQuery($query){
        if ($query) {
            $sqlQuery = "select * from {$this->tbl} where name LIKE '%{$query}%' or email LIKE '%{$query}%' or subject LIKE '%{$query}%';";
            $this->db->query($sqlQuery);
            return $this->db->resultSet();
        }
    }

}
