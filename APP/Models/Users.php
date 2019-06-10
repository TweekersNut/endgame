<?php

namespace APP\Models;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;
use APP\Core\Session as Session;
use APP\Helpers\IP as IP;

class Users {

    private $db;
    private $tbl = 'users';

    use CRUD;

    function __construct() {
        $this->db = new db;
    }

    public function check($user = null) {
        if ($user != null) {
            if (Session::exists('email')) {
                $user = Session::get('email');
                if (!$this->find($user)) {
                    $this->logout();
                }
            }
        }
    }

    public function find($user) {
        if ($user) {
            if (is_numeric($user)) {
                $sqlQuery = "select * from {$this->tbl} where id = :user";
            } elseif (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                $sqlQuery = "select * from {$this->tbl} where email = :user";
            } else {
                $sqlQuery = "select * from {$this->tbl} where username = :user";
            }
            $this->db->query($sqlQuery);
            $this->db->bind(":user", $user);
            return $this->db->single();
        }
        return false;
    }

    public function activate($accKey = null) {
        if ($accKey != null) {
            $sqlQuery = "select * from {$this->tbl} where acc_key = :acc_key";
            $this->db->query($sqlQuery);
            $this->db->bind(':acc_key', $accKey);
            $result = $this->db->single();
            if (!empty($result)) {
                if ($this->update($result->id, [
                            'status' => 1,
                            'ip' => IP::getIP(),
                            'acc_key' => Enc::generateRandomKey()
                        ])) {
                    return true;
                }
            }
        }
        return false;
    }

    public function findAccountByKey($acckey = null) {
        if ($acckey != null) {
            $sqlQuery = "select * from {$this->getTableName()} where acc_key = :accKey";
            $this->db->query($sqlQuery);
            $this->db->bind(":accKey", $acckey);
            return $this->db->single();
        }
        return false;
    }

    public function data($user) {
        if (is_numeric($user)) {
            $sqlQuery = "select * from {$this->tbl} where {$this->tbl}.id = :user";
        } elseif (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $sqlQuery = "select * from {$this->tbl}  where {$this->tbl}.email = :user";
        } else {
            $sqlQuery = "select * from {$this->tbl}  where {$this->tbl}.username = :user";
        }

        $this->db->query($sqlQuery);
        $this->db->bind(':user', $user);
        return $this->db->single();
    }

    public function login($user, $password) {
        if ($user && $password) {
            $findUser = $this->find($user);
            if ($findUser) {
                $sqlQuery = "select * from {$this->tbl} where email = :user";
                $this->db->query($sqlQuery);
                $this->db->bind(':user', $user);
                $result = $this->db->single();
                if ($result->password == encrypt($password)) {
                    //add here
                    if ($result->status == 1) {
                        Session::insert('email', $result->email);
                        Session::insert('U_ID', $result->id);
                        Session::insert('isLoggedIn', true);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function logout() {
        Session::del('email');
        Session::del('isLoggedIn');
        $this->update(Session::get('U_ID'), ['ip' => IP::getIP()]);
        Session::del('U_ID');
        return true;
    }

    public function listActive() {
        $sqlQuery = "select * from {$this->getTableName()} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function listInActive() {
        $sqlQuery = "select *  from {$this->getTableName()} where status = 0";
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

    public function activeCount() {
        $sqlQuery = "select count(*) as count from {$this->tbl} where status <> 0";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }

    public function inactiveCount() {
        $sqlQuery = "select count(*) as count from {$this->tbl} where status = 0";
        $this->db->query($sqlQuery);
        return $this->db->single();
    }

    public function isLoggedIn() {
        return (Session::exists('isLoggedIn')) ? true : false;
    }

    public function searchUser($username) {
        if ($username) {
            $sqlQuery = "select * from {$this->tbl} where {$this->tbl}.username LIKE '%{$username}%' or ({$this->tbl}.email LIKE '%{$username}%');";
            $this->db->query($sqlQuery);
            return $this->db->resultSet();
        }
        return false;
    }

    public function listByTypeAndOrder($type, $order) {
        $sqlQuery = "select * from {$this->tbl} order by ". $type ." ".$order;
        $this->db->query($sqlQuery);
        return $this->db->resultSet();
    }

}
