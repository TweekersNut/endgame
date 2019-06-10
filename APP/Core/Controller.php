<?php
namespace APP\Core;

class Controller{

    public function model($model){
        $load = "APP\Models\\{$model}";
        return new $load;
    }

    public function view($view, $data = []){
        if(file_exists('../APP/views/'. $view . '.php')){
            require_once('../APP/views/' . $view . '.php');
        }else{
            //print error
            die('404 View Not Found.');
        }
    }

}
