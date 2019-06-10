<?php

namespace APP\Controllers;

use APP\Core\Validator as Validator;
use APP\Core\Mailer as Mailer;

class Contact extends \APP\Core\Controller{

    private $contactModel;
    private $settingsModel;

    function __construct(){
        $this->contactModel = $this->model('Contacts');
        $this->settingsModel = $this->model('Settings');
    }

    public function index(){
        $data['page_title'] = "Contact | ". SITE_NAME;
        $data['setting_map'] = $this->settingsModel->getValue('contact.map')->_val;
        $data['contact_address'] = $this->settingsModel->getValue('contact.address')->_val;
        $data['contact_phone'] = $this->settingsModel->getValue('contact.phone')->_val;
        $data['contact_email'] = $this->settingsModel->getValue('contact.email')->_val;

        $this->view('inc/header',$data);
        $this->view('contact/index',$data);
        $this->view('inc/footer',$data);
    }

    public function submit(){
        if(isset($_POST) && isset($_POST['action']) && $_POST['action'] == 'ajax_submitQuery'){
            $validator = new Validator;
        $valData = $validator->validate($_POST,[
            'name' => [
                'required' => true,
                'min' => 5,
                'max' => 35
            ],
            'email' => [
                'required' => true,
                'min' => 11,
                'max' => 50,
            ],
            'subject' => [
                'required' => true,
                'min' => 5,
                'max' => 150
            ],
            'message' => [
                'required' => true,
                'min' => 5,
                'max' => 300
            ]
        ]);

        if($valData->passed()){
            if($this->contactModel->add([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
                'status' => 1
            ])){
                $mailer = new Mailer;
                $mailer->sendMail($_POST['email'],'Contact Query',
                '<h4>We have recieved your contact query : </h4>
                    <strong>Subject :</strong> '. $_POST['subject'].', <br />
                    <strong>Message :</strong> '. $_POST['message'] .', <br />

                    <br />
                    MVC 1.0 Mailer Bot.
                    ');
                if($mailer->getStatus() == true){
                    echo json_encode(['status' => 1,'msg' => 'Query submitted. Our staff will contact you soon. An email also been sent.']);
                }else{
                    echo json_encode(['status' => 1,'msg' => 'Query submitted. Our staff will contact you soon. Error sending email please contact staff.']);
                }
                
            }else{
                echo json_encode(['status' => 0,'msg' => 'Something Went Wrong please try again later.']);
            }
        }else{
            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
        }
        }else{
            echo json_encode(['status' => 0, 'msg' => 'Invalid Request.']);
        }
    }

}