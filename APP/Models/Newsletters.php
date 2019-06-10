<?php

namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Newsletters{

    private $db;
    private $tbl = 'newsletter';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

    public function exists($email){
        $sqlQuery = "select * from {$this->tbl} where email = :email";
        $this->db->query($sqlQuery);
        $this->db->bind(':email',$email);
        $this->db->execute();
        if($this->db->rowCount() > 0){
            return true;
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
    
    public function get($id){
        $sqlQuery = "select * from {$this->getTableName()} where id = :id";
        $this->db->query($sqlQuery);
        $this->db->bind(":id",$id);
        return $this->db->single();
    }

}