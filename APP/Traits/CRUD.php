<?php

namespace APP\Traits;

trait CRUD
{

    public function add( $data = [])
    {
        if (count($data)) {
            $keys = array_keys($data);
            $values = '';
            $binder = 1;
            foreach ($data as $field) {
                $values .= '?';
                if ($binder < count($data)) {
                    $values .= ', ';
                }
                $binder++;
            }
            $sqlQuery = "insert into `{$this->tbl}` (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            $this->db->query($sqlQuery);
            $binder = 1;
            foreach ($data as $para) {
                $this->db->bind($binder, $para);
                $binder++;
            }
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function update($id, $fields)
    {
        $set = '';
        $binder = 1;
        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($binder < count($fields)) {
                $set .= ', ';
            }
            $binder++;
        }
        $sqlQuery = "UPDATE {$this->tbl} SET {$set} WHERE id = {$id}";
        $this->db->query($sqlQuery);
            $binder = 1;
            foreach ($fields as $para) {
                $this->db->bind($binder, $para);
                $binder++;
            }
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        return false;
    }

    public function delete($id)
    {
        try {
            $sqlQuery = "delete from `{$this->tbl}` where id = :id";
            $this->db->query($sqlQuery);
            $this->db->bind(":id", $id);
            if ($this->db->execute()) {
                return true;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return false;
    }

    public function listAllAdmin(){
        $sqlQuery = "select * from {$this->tbl}";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    public function listAll(){
        $sqlQuery = "select * from {$this->tbl} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }
    
    
    public function getTableName(){
        return $this->tbl;
    }
    
    public function getTotalCount(){
        $sqlQuery = "select count(*) as count from {$this->tbl} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }
    
    public function getTotalCountAdmin(){
        $sqlQuery = "select count(*) as count from {$this->tbl}";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }

}
