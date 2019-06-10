<?php

namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Sliders {

    private $db;
    private $tbl = 'slider';

    use CRUD;

    function __construct() {
        $this->db = new db;
    }

    public function getVideoSliders() {
        $sqlQuery = "select * from {$this->getTableName()} where type <> 0 and status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function search($slider) {
        if ($slider) {
            $sqlQuery = "select * from {$this->tbl} where title LIKE '%{$slider}%' or (description LIKE '%{$slider}%');";
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
