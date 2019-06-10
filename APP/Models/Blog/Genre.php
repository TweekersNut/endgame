<?php

namespace APP\Models\Blog;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Genre{
    private $db;
    private $tbl = 'game_genre';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

}