<?php

namespace APP\Controllers;

use APP\Core\Validator as Validator;
use APP\Core\Session as Session;
use APP\Core\Redirect as Redirect;
use APP\Helpers\Logger as Logger;
use APP\Core\Mailer as Mailer;
use APP\Helpers\URL_Helper as URL;
use APP\Helpers\IP as IP;

class Users extends \APP\Core\Controller {

    private $usersModel;
    private $logHandler;

    function __construct() {
        $this->usersModel = $this->model('Users');
        $this->logHandler = new Logger(__CLASS__);
    }

    public function index() {
        if ($this->usersModel->isLoggedIn()) {
            $data['page_title'] = "Users | Index | " . SITE_NAME;

            $this->view('inc/header', $data);
            $this->view('users/index', $data);
            $this->view('inc/footer', $data);
        } else {
            Redirect::to('login');
        }
    }

    public function login() {
        $data['page_title'] = "Users | Login | " . SITE_NAME;

        $this->view('inc/header', $data);
        if ($this->usersModel->isLoggedIn()) {
            Redirect::to(URL_ROOT . 'admin/index');
        } else {
            $this->view('users/login', $data);
        }
        $this->view('inc/footer', $data);
    }

    public function logout() {
        if ($this->usersModel->logout()) {
            Redirect::to('login');
        } else {
            //$this->logger->error("Unable to logout user ". Session::get('email') . "");
        }
    }

    public function auth() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processLogin') {
            $validator = new Validator();
            $valData = $validator->validate($_POST, [
                'email' => [
                    'required' => true,
                    'min' => 11,
                ],
                'password' => [
                    'required' => true,
                ]
            ]);
            if ($valData->passed()) {
                if ($this->usersModel->find($_POST['email'])) {
                    if ($this->usersModel->login($_POST['email'], $_POST['password'])) {
                        echo json_encode(['status' => 1, 'msg' => ['Login Succes! ' . Session::get('email') . " Redirecting ..."]]);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Error invalid email/password or account is pending activation.']]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => ['User not found.']]);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
        }
    }

    public function forgotPassword() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processForgotPassword') {
            $validator = new Validator();
            $valData = $validator->validate($_POST, [
                'email' => [
                    'required' => true,
                    'min' => 11
                ]
            ]);
            if ($valData->passed()) {
                if ($this->usersModel->find($_POST['email'])) {
                    $userDetails = $this->usersModel->data($_POST['email']);
                    //send reset email.
                    $mailer = new Mailer();
                    $mailBody = "<p>"
                            . "Please click the link below and reset your password."
                            . "</br>"
                            . "</br>"
                            . "<a href='" . URL::baseURL('users/resetpassword/' . $userDetails->acc_key) . "'>" . URL::baseURL('users/resetpassword/' . $userDetails->acc_key) . " </a>"
                            . "</p>";
                    $mailer->sendMail($_POST['email'], 'Password Recovery', $mailBody);
                    if ($mailer->getStatus() == true) {
                        echo json_encode(['status' => 1, 'msg' => ['Password Recovery Email Sent. Please check your inbox/spam folder.']]);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while sending password recovery email. Please try again later or contact staff.']]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => ['User not found.']]);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalud Request.']]);
        }
    }

    public function resetpassword($accKey) {
        if ($accKey) {
            $data['page_title'] = "Users | Reset Password | " . SITE_NAME;
            $data['acc_key'] = (int) $accKey;
            $this->view('inc/header', $data);
            if ($this->usersModel->findAccountByKey($data['acc_key'])) {
                $this->view('users/new_password', $data);
            } else {
                $this->view('users/invalid_request', $data);
            }
            $this->view('inc/footer', $data);
        }
    }

    public function setnewPassword() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processSetupNewPassword') {
            $validator = new Validator();
            $valData = $validator->validate($_POST, [
                'password' => [
                    'required' => true,
                    'min' => 8
                ],
                'confirm' => [
                    'required' => true,
                    'matches' => 'password'
                ]
            ]);

            if ($valData->passed()) {
                if (pwdStrength($_POST['password'])) {
                    $userData = $this->usersModel->findAccountByKey($_POST['key']);
                    if (decrypt($userData->password) != $_POST['password']) {
                        if ($this->usersModel->update($userData->id, [
                                    'password' => encrypt($_POST['password']),
                                    'IP' => IP::getIP(),
                                    'acc_key' => generateRandomKey(),
                                ])) {
                            echo json_encode(['status' => 1, 'msg' => ['All security token updated.']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something went wrong while setting new token. Please try again later or contact staff.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['You can not use old password as new password. Please try again.']]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => ['Weak Password. Password must contain number,upper and lower case and special char.']]);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
        }
    }

    public function add() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processAddUser') {
            $validator = new Validator();
            $valData = $validator->validate($_POST, [
                'username' => [
                    'required' => true,
                    'min' => 8,
                    'max' => 35,
                    'unique' => $this->usersModel->getTableName()
                ],
                'email' => [
                    'required' => true,
                    'min' => 11,
                    'max' => 50,
                    'unique' => $this->usersModel->getTableName()
                ],
                'password' => [
                    'required' => true,
                    'min' => 8,
                    'max' => 50,
                ]
            ]);
            if ($valData->passed()) {
                if (pwdStrength($_POST['password'])) {
                    if ($this->usersModel->add([
                                'username' => str_replace(" ", "_", $_POST['username']),
                                'email' => $_POST['email'],
                                'password' => encrypt($_POST['password']),
                                'avatar' => URL_ROOT . 'img/blank_avatar.png',
                                'added_on' => date("Y-m-d H:i:s"),
                                'IP' => IP::getIP(),
                                'acc_key' => generateRandomKey(),
                                'bio' => 'Tell us about yourself.',
                                'status' => 1
                            ])) {
                        $mailer = new Mailer();
                        $mailBody = "<p>"
                                . "Your account password is : " . $_POST['password'] . ""
                                . "</br>"
                                . "</p>";
                        $mailer->sendMail($_POST['email'], 'Welcome ' . $_POST['email'] . '', $mailBody);
                        if ($mailer->getStatus() == true) {
                            echo json_encode(['status' => 1, 'msg' => ['New user created "' . $_POST['email'] . '" Password email sent. Please check your inbox/spam folder.']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['New User created but something went wrong while sending password email. Please try again later or contact staff.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while adding new user. Please try again later.']]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => ['Weak Password. Password must contain number,upper and lower case and special char.']]);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
        }
    }

    public function toggleUserStatus() {
        if (isset($_POST)) {
            switch (strtolower($_POST['action'])) {
                case 'ajax_processinactivateuser':
                    if ($this->usersModel->update($_POST['id'], [
                                'status' => 0
                            ])) {
                        echo json_encode(['status' => 1, 'msg' => ['User marked inactive.']]);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking user inactive. Please try again later.']]);
                    }
                    break;
                case 'ajax_processactivateuser':
                    if ($this->usersModel->update($_POST['id'], [
                                'status' => 1
                            ])) {
                        echo json_encode(['status' => 1, 'msg' => ['User marked active.']]);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking user active. Please try again later.']]);
                    }
                    break;
                default:
                    echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    break;
            }
        }
    }

    public function deleteUser() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteUser') {
            if ($this->usersModel->delete($_POST['id'])) {
                echo json_encode(['status' => 1, 'msg' => ['User deleted.']]);
            } else {
                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting user. Please try again later.']]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
        }
    }

    public function editUser() {
        if (isset($_POST) && $_POST['action'] == 'ajax_processEditUser') {
            if ($this->usersModel->update($_POST['id'], [
                        'username' => str_replace(" ", "_", $_POST['username']),
                        'email' => $_POST['email'],
                        'password' => encrypt($_POST['password']),
                    ])) {
                echo json_encode(['status' => 1, 'msg' => ['User data updated.']]);
            } else {
                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while editting user. Please try again later.']]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
        }
    }

}
