<?php

namespace APP\Controllers;

use APP\Core\Validator as Validator;

class Newsletter extends \APP\Core\Controller{

    private $newsletterModel;

    function __construct(){
        $this->newsletterModel = $this->model('Newsletters');
    }

    public function subscribe(){
        if($_POST['action'] == 'ajax_subscribeNewsletter'){
            $validator = new Validator;
            $valData = $validator->validate($_POST,[
                'email' => [
                    'required' => true,
                    'min' => '11',
                    'max' => 50
                ]
            ]);
            if($valData->passed()){
                if($this->newsletterModel->exists($_POST['email']) == false){
                    if($this->newsletterModel->add([
                        'email' => $_POST['email'],
                        'status' => 1
                    ])){
                        echo json_encode(['status' => 1,'msg' => $_POST['email'] . " subscribed to newsletter."]);     
                    }else{
                        echo json_encode(['status' => 0,'msg' => 'Something Went Wrong Please Try Again Later.']);        
                    }
                }else{
                    echo json_encode(['status' => 0,'msg' => htmlentities($_POST['email'] . " already subscribed to newsletter.")]);        
                }
            }else{
                echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
            }
        }else{
            echo json_encode(['status' => 0,'msg' => 'Invalid Request.']);
        }
    }

}