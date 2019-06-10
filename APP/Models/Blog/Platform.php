<?php

namespace APP\Models\Blog;

use APP\Core\Database as db;
use APP\Traits\CRUD as CRUD;

class Platform{
    private $db;
    private $tbl = 'game_platform';

    use CRUD;

    function __construct()
    {
        $this->db = new db;
    }

}