<?php

namespace APP\Core;

use \Exception;
use \PDO;

class Database{

    private $host = DB_HOST;
    private $db = DB_DB;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $dbh;
    private $stmt;
    private $error;

    function __construct()
    {
        try{
            $this->dbh = new PDO("mysql:host=". $this->host .";dbname=". $this->db . "", $this->user, $this->pass);
            // set the PDO error mode to exception
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
           $this->error[] = $e->getMessage();
        }
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param,$value,$type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value,$type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }
}