<?php
namespace APP\Controllers;

use APP\Core\Redirect as Redirect;

class Advert extends \APP\Core\Controller{
    
    private $advertModel;
    
    function __construct() {
        $this->advertModel = $this->model('Adverts');
    }
    
    public function redirect($id){
        $newClick = 0;
        $oldData = $this->advertModel->get($id);
        $newClick = $oldData->clicks + 1;
        if($this->advertModel->update($id,[
            'clicks' => $newClick
        ])){
                Redirect::to($oldData->link);
        }else{
            echo "Something Went Wrong. Please try again later.";
        }
    }
    
    
}
