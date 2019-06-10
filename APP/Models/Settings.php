<?php

namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Settings{

    private $db;
    private $tbl = 'settings';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

    public function getValue($key = null){
        if($key != null){
            $sqlQuery = "select * from {$this->tbl} where _key = :key";
            $this->db->query($sqlQuery);
            $this->db->bind(':key',$key);
            return $this->db->single();
        }
        return false;
    }

    public function getKey($value = null){
        if($value != null){
            $sqlQuery = "select * from {$this->tbl} where _val = :val";
            $this->db->query($sqlQuery);
            $this->db->bind(':val',$value);
            return $this->db->single();
        }
        return false;
    }

    public function listSettings($part = null){
        if($part != null){
            $sqlQuery = "select * from {$this->tbl} where _key LIKE '". $part . "%'";
        }else{
            $sqlQuery = "select * from {$this->tbl}";
        }
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    public function getSettingsByType($type){
        $sqlQuery = "select * from {$this->getTableName()} where _key LIKE '%{$type}%' ";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
}