<?php

namespace APP\Controllers;

use APP\Core\Redirect as Redirect;
use APP\Models\Users as Users;
use APP\Models\Settings as Settings;
use APP\Core\Session as Session;
use APP\Helpers\Logger as Logger;
use APP\Helpers\IP as IP;
use APP\Models\Blog\Posts as Posts;
use APP\Models\Blog\Category as Category;
use APP\Models\Blog\Genre as Genre;
use APP\Models\Blog\Platform as Platform;
use APP\Models\Newsletters as News;
use APP\Models\Contacts as Contact;
use APP\Helpers\URL_Helper as URL;
use APP\Helpers\Pagination as Pagi;
use APP\Helpers\Upload as Upload;
use APP\Core\Validator as Validator;
use APP\Models\Sliders as Sliders;
use APP\Models\Adverts as Adverts;
use APP\Models\Newsletters as Newsletters;
use APP\Core\Mailer as Mailer;

/*
 * Admin Controller Router.
 */

class Admin extends \APP\Core\Controller {

    private $userModel;
    private $settingModel;
    private $blogPostModel;
    private $blogCategoryModel;
    private $blogGenreModel;
    private $blogPlatformModel;
    private $logHandler;
    private $newsModel;
    private $contactModel;
    private $sliderModel;
    private $advertModel;
    private $newsletterModel;

    function __construct() {
        $this->userModel = new Users();
        $this->settingModel = new Settings();
        $this->logHandler = new Logger(__CLASS__);
        $this->blogPostModel = new Posts();
        $this->blogCategoryModel = new Category();
        $this->blogGenreModel = new Genre();
        $this->blogPlatformModel = new Platform();
        $this->newsModel = new News();
        $this->contactModel = new Contact();
        $this->sliderModel = new Sliders();
        $this->advertModel = new Adverts();
        $this->newsletterModel = new Newsletters();
    }

    public function index() {
        if ($this->userModel->isLoggedIn()) {

            $data['page_title'] = SITE_NAME . "| Admin | Dashboard";
            $data['user_data'] = $this->userModel->data(Session::get('email'));
            //Log Admin Action

            $this->logHandler->writeInfo("User:" . $data['user_data']->email . "|ID:" . $data['user_data']->id . "| Logged In | IP:" . IP::getIP() . "| Browser:" . $_SERVER['HTTP_USER_AGENT']);
            //counts
            $data['total_users_count'] = $this->userModel->getTotalCountAdmin()->count;
            $data['total_blog_posts_count'] = $this->blogPostModel->getTotalCountAdmin()->count;
            $data['total_users_active_count'] = $this->userModel->activeCount()->count;
            $data['total_users_inactive_count'] = $this->userModel->inactiveCount()->count;
            $data['total_blog_category_count'] = $this->blogCategoryModel->getTotalCountAdmin()->count;
            $data['total_blog_genre_count'] = $this->blogGenreModel->getTotalCountAdmin()->count;
            $data['total_blog_platform_count'] = $this->blogPlatformModel->getTotalCountAdmin()->count;
            $data['total_newsletter_sub_count'] = $this->newsModel->getTotalCountAdmin()->count;
            $data['total_newsletter_active_count'] = $this->newsModel->activeCount()->count;
            $data['total_newsletter_inactive_count'] = $this->newsModel->inactiveCount()->count;
            $data['total_contact_count'] = $this->contactModel->getTotalCountAdmin()->count;
            $data['total_contact_resolve_count'] = $this->contactModel->inactiveCount()->count;
            $data['total_contact_new_count'] = $this->contactModel->activeCount()->count;

            $this->view('admin/inc/header', $data);
            $this->view('admin/inc/sidebar', $data);
            $this->view('admin/dashboard/index', $data);
            $this->view('admin/inc/footer', $data);
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function login() {
        $data['page_title'] = SITE_NAME . "| Admin | Login";

        if ($this->userModel->isLoggedIn()) {
            Redirect::to(URL_ROOT . 'admin/index');
        } else {
            $this->view('admin/login/index', $data);
        }
    }

    public function users($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {

            switch (strtolower($view)) {
                case 'add':
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Add";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/add', $data);
                    $this->view('admin/inc/footer', $data);

                    break;
                case 'search':
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Search";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['search_query'] = $_POST['query'];

                    $data['all_user_data'] = $this->userModel->searchUser($data['search_query']);



                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/search', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'editprofile':
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['page_title'] = SITE_NAME . "| Admin | {$data['user_data']->username} | Edit Profile";

                    if (isset($_POST) && isset($_POST['user_editprofile'])) {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'password' => [
                                'required' => true,
                                'min' => 8,
                                'max' => 50,
                            ],
                            'bio' => [
                                'min' => 20,
                                'max' => 300
                            ]
                        ]);

                        if ($valData->passed()) {
                            if (!empty($_FILES['avatar']['name'])) {
                                $upload = new Upload($_FILES['avatar'], PUBLIC_ROOT . "/img/avatar/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));
                                $imgResult = $upload->getResult();
                                $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                                if ($imgResult['type'] == 'success') {
                                    if ($this->userModel->update(Session::get('U_ID'), [
                                                'username' => str_replace(" ", "_", $_POST['username']),
                                                'email' => $_POST['email'],
                                                'password' => encrypt($_POST['password']),
                                                'bio' => $_POST['bio'],
                                                'avatar' => URL_ROOT . $realImgPath
                                            ])) {
                                        $data['update_status'] = "Profile Succesfully Updated.";
                                    } else {
                                        $data['update_status'] = "Something Went wrong while updating profile. Please try again later.";
                                    }
                                } else {
                                    $data['update_status'] = $imgResult['message'];
                                }
                            } else {
                                if ($this->userModel->update(Session::get('U_ID'), [
                                            'username' => str_replace(" ", "_", $_POST['username']),
                                            'email' => $_POST['email'],
                                            'password' => encrypt($_POST['password']),
                                            'bio' => htmlspecialchars($_POST['bio'])
                                        ])) {
                                    $data['update_status'] = "Profile Succesfully Updated.";
                                } else {
                                    $data['update_status'] = "Something Went wrong while updating profile. Please try again later.";
                                }
                            }
                        } else {
                            $data['update_status'] = $valData->errors();
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/edit_profile', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Users | View";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));


                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_user_data'] = $this->userModel->listAllAdmin();

                        $totalItems = count($data['all_user_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/users/view/') . 'page/(:num)';

                        $data['all_user_data'] = array_slice($data['all_user_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_user_data'] = $this->userModel->listAllAdmin();

                        $totalItems = count($data['all_user_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/users/view/') . 'page/(:num)';

                        $data['all_user_data'] = array_slice($data['all_user_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }


                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function usersFilter() {
        if (!is_null($_POST['filter'])) {
            switch ($_POST['filter']) {
                case 1:
                    //ID ASC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | I.D ASC.";
                    $data['filter_name'] = "I.D Ascending";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('id', 'ASC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 2:
                    //ID DESC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | I.D DESC.";
                    $data['filter_name'] = "I.D Desc.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('id', 'DESC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 3:
                    //Email ASC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | Email ASC.";
                    $data['filter_name'] = "Email ASC.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('email', 'ASC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 4:
                    //Email DSC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | Email DESC.";
                    $data['filter_name'] = "Email Desc.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('email', 'DESC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 5:
                    //username ASC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | Username ASC.";
                    $data['filter_name'] = "Username ASC.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('username', 'ASC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 6:
                    //username DESC
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | Username DESC.";
                    $data['filter_name'] = "Username Desc.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listByTypeAndOrder('username', 'DESC');

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 7:
                    //show only active user.
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | Active";
                    $data['filter_name'] = "Active Users.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 8:
                    //show only inactive user.
                    $data['page_title'] = SITE_NAME . "| Admin | Users | Filter | In-Active";
                    $data['filter_name'] = "In-Active Users.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_user_data'] = $this->userModel->listInActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/users/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    echo "Invalid Filter.";
                    break;
            }
        } else {
            echo "Invalid Filter.";
        }
    }

    public function slider($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'add':
                    $data['page_title'] = SITE_NAME . "| Admin | Slider | Add";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    if (isset($_POST) && isset($_POST['add_new_slider'])) {
                        //Process Query
                        $data['slider_add_type'] = 'dark';
                        $data['slider_add_msg'] = "Invalid Request. Please contact Developer.";

                        $upload = new Upload($_FILES['slider_img'], PUBLIC_ROOT . "/img/slider/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));

                        $imgResult = $upload->getResult();
                        $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                        if ($imgResult['type'] == 'success') {
                            if ($this->sliderModel->add([
                                        'img' => URL_ROOT . $realImgPath,
                                        'title' => $_POST['title'],
                                        'description' => $_POST['desc'],
                                        'link' => $_POST['link'],
                                        'btn_text' => $_POST['btn'],
                                        'type' => $_POST['type'],
                                        'status' => $_POST['status']
                                    ])) {
                                $data['slider_add_type'] = 'success';
                                $data['slider_add_msg'] = "New slider added!";
                            } else {
                                $data['slider_add_type'] = 'danger';
                                $data['slider_add_msg'] = "Something Went Wrong. Please try again later.";
                            }
                        } else {
                            $data['slider_add_type'] = 'warning';
                            $data['slider_add_msg'] = $imgResult['message'];
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/slider/add', $data);
                    $this->view('admin/inc/footer', $data);

                    break;
                case 'search':
                    $data['page_title'] = SITE_NAME . "| Admin | Slider | Search";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['search_query'] = $_POST['query'];

                    $data['all_slider_data'] = $this->sliderModel->search($data['search_query']);



                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/slider/search', $data);
                    $this->view('admin/inc/footer', $data);

                    break;
                case 'deleteslider':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteSlider') {
                        if ($this->sliderModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Slider deleted success!']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting slider. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }

                    break;
                case 'togglesliderstatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivateslider':
                                if ($this->sliderModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Slider marked In-active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking slider In-active. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivateslider':
                                if ($this->sliderModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Slider marked active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking slider active. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Slider | View";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));


                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_slider_data'] = $this->sliderModel->listAllAdmin();

                        $totalItems = count($data['all_slider_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/slider/view/') . 'page/(:num)';

                        $data['all_slider_data'] = array_slice($data['all_slider_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_slider_data'] = $this->sliderModel->listAllAdmin();

                        $totalItems = count($data['all_slider_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/slider/view/') . 'page/(:num)';

                        $data['all_slider_data'] = array_slice($data['all_slider_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }


                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/slider/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function sliderFilter() {
        if (!is_null($_POST['filter'])) {
            switch ($_POST['filter']) {
                case 1:
                    //show only active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Slider | Filter | Active";
                    $data['filter_name'] = "Active Slider.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_slider_data'] = $this->sliderModel->listActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/slider/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;

                case 2:
                    //show only in-active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Slider | Filter | In-Active";
                    $data['filter_name'] = "In-Active Slider.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_slider_data'] = $this->sliderModel->listInActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/slider/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    echo "Invalid Filter.";
                    break;
            }
        } else {
            echo "Invalid Filter.";
        }
    }

    public function contact($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'deletequery':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->contactModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Contact Query Deleted.']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting query. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'togglequerystatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processopenquery':
                                if ($this->contactModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Contact Query Marked Open.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking query open. Please try again later.']]);
                                }
                                break;
                            case 'ajax_processclosequery':
                                if ($this->contactModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Contact Query Marked Close.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking query close. Please try again later.']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    }
                    break;
                case 'search':
                    $data['page_title'] = SITE_NAME . "| Admin | Contact | Search";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['search_query'] = $_POST['query'];

                    $data['all_contact_data'] = $this->contactModel->searchQuery($data['search_query']);



                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/contact/search', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Contact | View";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));


                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_contact_data'] = $this->contactModel->listAllAdmin();

                        $totalItems = count($data['all_contact_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/contact/view/') . 'page/(:num)';

                        $data['all_contact_data'] = array_slice($data['all_contact_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_contact_data'] = $this->contactModel->listAllAdmin();

                        $totalItems = count($data['all_contact_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/contact/view/') . 'page/(:num)';

                        $data['all_contact_data'] = array_slice($data['all_contact_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }


                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/contact/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function settings($view = null) {
        switch ($view) {
            case 'update':
                if (isset($_POST) && $_POST['action'] == "ajax_processUpdateSetting") {
                    if ($this->settingModel->update($_POST['id'], [
                                '_val' => $_POST['val']
                            ])) {
                        echo json_encode(['status' => 1, 'msg' => ['Settings Update.']]);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while update setting. Please try again later.']]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                }
                break;
            default:
                $data['page_title'] = SITE_NAME . "| Admin | Settings";
                $data['user_data'] = $this->userModel->data(Session::get('email'));

                $data['contact_settings'] = $this->settingModel->getSettingsByType('contact');
                $data['email_settings'] = $this->settingModel->getSettingsByType('email');
                $data['site_settings'] = $this->settingModel->getSettingsByType('site');
                $data['upload_settings'] = $this->settingModel->getSettingsByType('upload');
                $data['pagi_settings'] = $this->settingModel->getSettingsByType('pagination');
                $data['editor_settings'] = $this->settingModel->getSettingsByType('editor');

                $this->view('admin/inc/header', $data);
                $this->view('admin/inc/sidebar', $data);
                $this->view('admin/settings/index', $data);
                $this->view('admin/inc/footer', $data);
                break;
        }
    }

    public function advert($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'add':
                    $data['page_title'] = SITE_NAME . "| Admin | Adverts | Add";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    if (isset($_POST) && isset($_POST['add_new_banner'])) {
                        //Process Query
                        $data['advert_add_type'] = 'dark';
                        $data['advert_add_msg'] = "Invalid Request. Please contact Developer.";

                        $upload = new Upload($_FILES['banner_img'], PUBLIC_ROOT . "/img/banners/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));

                        $imgResult = $upload->getResult();
                        $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                        if ($imgResult['type'] == 'success') {
                            if ($this->advertModel->add([
                                        'img' => URL_ROOT . $realImgPath,
                                        'name' => str_replace(" ", "_", $_POST['name']),
                                        'link' => $_POST['link'],
                                        'clicks' => 0,
                                        'area' => $_POST['area'],
                                        'status' => $_POST['status']
                                    ])) {
                                $data['advert_add_type'] = 'success';
                                $data['advert_add_msg'] = "New Advert Banner added!";
                            } else {
                                $data['advert_add_type'] = 'danger';
                                $data['advert_add_msg'] = "Something Went Wrong. Please try again later.";
                            }
                        } else {
                            $data['advert_add_type'] = 'warning';
                            $data['advert_add_msg'] = $imgResult['message'];
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/advert/add', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'search':
                    $data['page_title'] = SITE_NAME . "| Admin | Advert | Search";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['search_query'] = $_POST['query'];

                    $data['all_advert_data'] = $this->advertModel->search($data['search_query']);



                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/advert/search', $data);
                    $this->view('admin/inc/footer', $data);

                    break;
                case 'deletequery':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->advertModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Banner Deleted.']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting advert banner. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'togglequerystatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processopenquery':
                                if ($this->advertModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Advert Marked Open.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking advert open. Please try again later.']]);
                                }
                                break;
                            case 'ajax_processclosequery':
                                if ($this->advertModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Advert Query Marked Close.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking advert close. Please try again later.']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    }
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Adverts";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_advert_data'] = $this->advertModel->listAllAdmin();

                        $totalItems = count($data['all_advert_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/advert/view/') . 'page/(:num)';

                        $data['all_advert_data'] = array_slice($data['all_advert_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_advert_data'] = $this->advertModel->listAllAdmin();

                        $totalItems = count($data['all_advert_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/advert/view/') . 'page/(:num)';

                        $data['all_advert_data'] = array_slice($data['all_advert_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/advert/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to('admin/login');
        }
    }

    public function advertFilter() {
        if (!is_null($_POST['filter'])) {
            switch ($_POST['filter']) {
                case 1:
                    //show only active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Advert | Filter | Active";
                    $data['filter_name'] = "Active Slider.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_advert_data'] = $this->advertModel->listActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/advert/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;

                case 2:
                    //show only in-active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Advert | Filter | In-Active";
                    $data['filter_name'] = "In-Active Slider.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_advert_data'] = $this->advertModel->listInActive();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/advert/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    echo "Invalid Filter.";
                    break;
            }
        } else {
            echo "Invalid Filter.";
        }
    }

    public function newsletter($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'deletequery':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->newsletterModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Subscriber Removed.']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while removing subscriber. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'add':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processAddQuery') {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'email' => [
                                'required' => true,
                                'min' => 11,
                                'max' => 50,
                                'unique' => $this->newsletterModel->getTableName()
                            ]
                        ]);
                        if ($valData->passed()) {
                            if ($this->newsletterModel->add([
                                        'email' => $_POST['email'],
                                        'status' => 1
                                    ])) {
                                echo json_encode(['status' => 1, 'msg' => ['New Subscriber Added!.']]);
                            } else {
                                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while adding new subscriber. Please try again later.']]);
                            }
                        } else {
                            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'send':
                    $data['page_title'] = SITE_NAME . "| Admin | Newsletter | Sendnews";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_subscribers_data'] = $this->newsletterModel->listAllAdmin();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/newsletter/send_news', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'sendnews':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processSendNewsletter') {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'subject' => [
                                'required' => true,
                                'min' => 10,
                                'max' => 100
                            ],
                            'message' => [
                                'required' => true
                            ]
                        ]);
                        if ($valData->passed()) {
                            $mailer = new Mailer();
                            if ($_POST['users'][0] == -1) {
                                $emails = array();
                                $data['all_newsletter_data'] = $this->newsletterModel->listAllAdmin();
                                foreach ($data['all_newsletter_data'] as $subData) {
                                    $emails[] = $subData->email;
                                }
                                //loop complete subs data.
                                $mailer->sendMailBulk($emails, $_POST['subject'], $_POST['message'], '');
                                if ($mailer->getStatus()) {
                                    echo json_encode(['status' => 1, 'msg' => ['News Letter Sent Success.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something went wrong while sending newsletter. Please try again later.']]);
                                }
                            } else {
                                //loop selected data.
                                $emails = array();
                                foreach ($_POST['users'] as $emailData) {
                                    $emails[] = $this->newsletterModel->get($emailData)->email;
                                }
                                $mailer->sendMailBulk($emails, $_POST['subject'], $_POST['message'], '');
                                if ($mailer->getStatus()) {
                                    echo json_encode(['status' => 1, 'msg' => ['News Letter Sent Success.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something went wrong while sending newsletter. Please try again later.']]);
                                }
                            }
                        } else {
                            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;

                case 'togglenewsletterstatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivate':
                                if ($this->newsletterModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Subscriber marked In-active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking slider In-active. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivate':
                                if ($this->newsletterModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Subscriber marked active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking slider active. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }

                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Newsletter";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_newsletter_data'] = $this->newsletterModel->listAllAdmin();

                        $totalItems = count($data['all_newsletter_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/newsletter/view/') . 'page/(:num)';

                        $data['all_newsletter_data'] = array_slice($data['all_newsletter_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_newsletter_data'] = $this->newsletterModel->listAllAdmin();

                        $totalItems = count($data['all_newsletter_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/newsletter/view/') . 'page/(:num)';

                        $data['all_newsletter_data'] = array_slice($data['all_newsletter_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/newsletter/subscribers', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function bugreport($view = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'send':
                    $data['page_title'] = SITE_NAME . "| Admin | Bug Report";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    if (isset($_POST) && isset($_POST['send_bug_report'])) {
                        // Looping all files

                        $upload = new Upload($_FILES['bug_img'], PUBLIC_ROOT . "/img/bugreports/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));

                        $imgResult = $upload->getResult();
                        $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));

                        if ($imgResult['type'] == 'success') {
                            $mailer = new Mailer();
                            $body = "<html>"
                                    . "<h3>Bug Name : </h3> <p> {$_POST['name']} </p> <br />"
                                    . "<h3>Bug Summary : </h3> <p>{$_POST['summary']}</p> <br />"
                                    . "<h3>Bug Component : </h3> <p>{$_POST['components']}</p> <br />"
                                    . "<h3>Bug Explanation : </h3> <p>{$_POST['explain']}</p> <br />"
                                    . "<h3>Bug Type : </h3> <p>{$_POST['type']}</p> <br />"
                                    . "<h3>Submitted By : </h3> <p>{$data['user_data']->username} ({$data['user_data']->email})</p> <br />"
                                    . "<h3>Submitted On : <p>" . date("Y-m-d H:i:s") . "</p> <br />"
                                    . "<h3>Bug Image : </h3> <a href='" . URL_ROOT . $realImgPath . "' target='_blank'><img src='" . URL_ROOT . $realImgPath . "' width='250px' height='250px' /></a> <br />"
                                    . "<br />"
                                    . "<b>TweekersNut Network Bug Report Bot</b>"
                                    . "</html>";
                            //add attachments.
                            $mailer->sendMail('taranpreet@tweekersnut.com', "BUG REPORT [" . SITE_NAME . "] ", $body, '');
                            if ($mailer->getStatus()) {
                                $data['msg_type'] = 'info';
                                $data['msg_msg'] = 'Bug report submitted. Our developer can contact you via email. Thank you for your support.';
                            } else {
                                $data['msg_type'] = 'danger';
                                $data['msg_msg'] = 'Something Went Wrong while sending bug report. Please try again later or send direct email to taranpreet@tweekersnut.com';
                            }
                        } else {
                            //print error of image stuff.
                            $data['msg_type'] = 'danger';
                            $data['msg_msg'] = $imgResult['message'];
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/bugreport/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Bug Report";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/bugreport/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function requestFeature($view = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'send':
                    $data['page_title'] = SITE_NAME . "| Admin | Request New Feature";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    if (isset($_POST) && isset($_POST['send_feature_request'])) {
                        $mailer = new Mailer();
                        $body = "<html>"
                                . "<h3>Request Name : </h3> <p> {$_POST['name']} </p> <br />"
                                . "<h3>Request Summary : </h3> <p>{$_POST['summary']}</p> <br />"
                                . "<h3>Request Component : </h3> <p>{$_POST['components']}</p> <br />"
                                . "<h3>Request Explanation : </h3> <p>{$_POST['explain']}</p> <br />"
                                . "<h3>Submitted By : </h3> <p>{$data['user_data']->username} ({$data['user_data']->email})</p> <br />"
                                . "<h3>Submitted On : <p>" . date("Y-m-d H:i:s") . "</p> <br />"
                                . "<br />"
                                . "<b>TweekersNut Network Bug Report Bot</b>"
                                . "</html>";
                        //add attachments.
                        $mailer->sendMail('taranpreet@tweekersnut.com', "FEATURE REQUEST [" . SITE_NAME . "][" . URL_ROOT . "] ", $body, '');
                        if ($mailer->getStatus()) {
                            $data['msg_type'] = 'info';
                            $data['msg_msg'] = 'Feature Request submitted. Our developer will contact you via email. Thank you for your support.';
                        } else {
                            $data['msg_type'] = 'danger';
                            $data['msg_msg'] = 'Something Went Wrong while sending feature request. Please try again later or send direct email to taranpreet@tweekersnut.com';
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/request_feature/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Request New Feature";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/request_feature/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function blog($view = null, $pagi = null, $num = null) {
        if ($this->userModel->isLoggedIn()) {
            switch (strtolower($view)) {
                case 'category':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Category";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_category_data'] = $this->blogCategoryModel->listAllAdmin();

                        $totalItems = count($data['all_category_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/blog/category/') . 'page/(:num)';

                        $data['all_category_data'] = array_slice($data['all_category_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_category_data'] = $this->blogCategoryModel->listAllAdmin();

                        $totalItems = count($data['all_category_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/blog/category/') . 'page/(:num)';

                        $data['all_category_data'] = array_slice($data['all_category_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/category', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'deletecategory':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->blogCategoryModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Blog Category Removed!']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting blog category. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request']]);
                    }
                    break;
                case 'addcategory':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processAddQuery') {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'name' => [
                                'required' => true,
                                'max' => 35
                            ],
                            'desc' => [
                                'required' => true,
                                'max' => 50
                            ]
                        ]);

                        if ($valData->passed()) {
                            if ($this->blogCategoryModel->add([
                                        'name' => $_POST['name'],
                                        'desc' => $_POST['desc'],
                                        'status' => $_POST['status']
                                    ])) {
                                echo json_encode(['status' => 1, 'msg' => ['New Blog Category Added!']]);
                            } else {
                                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while adding new category. Please try again later.']]);
                            }
                        } else {
                            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'togglecategorystatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivate':
                                if ($this->blogCategoryModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Category marked In-active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking category In-active. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivate':
                                if ($this->blogCategoryModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Category marked active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking category active. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'genre':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Genre";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_genre_data'] = $this->blogGenreModel->listAllAdmin();

                        $totalItems = count($data['all_genre_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/blog/genre/') . 'page/(:num)';

                        $data['all_genre_data'] = array_slice($data['all_genre_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_genre_data'] = $this->blogGenreModel->listAllAdmin();

                        $totalItems = count($data['all_genre_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/blog/genre/') . 'page/(:num)';

                        $data['all_genre_data'] = array_slice($data['all_genre_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/genre', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'deletegenre':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->blogGenreModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Blog Genre Removed!']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting blog genre. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request']]);
                    }
                    break;
                case 'togglegenrestatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivate':
                                if ($this->blogGenreModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Genre marked In-active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking genre In-active. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivate':
                                if ($this->blogGenreModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Genre marked active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking genre active. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'addgenre':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processAddQuery') {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'name' => [
                                'required' => true
                            ]
                        ]);

                        if ($valData->passed()) {
                            if ($this->blogGenreModel->add([
                                        'name' => $_POST['name'],
                                        'status' => $_POST['status']
                                    ])) {
                                echo json_encode(['status' => 1, 'msg' => ['New Blog Genre Added!']]);
                            } else {
                                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while adding new genre. Please try again later.']]);
                            }
                        } else {
                            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;

                case 'platform':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Platform";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_platform_data'] = $this->blogPlatformModel->listAllAdmin();

                        $totalItems = count($data['all_platform_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/blog/platform/') . 'page/(:num)';

                        $data['all_platform_data'] = array_slice($data['all_platform_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_platform_data'] = $this->blogPlatformModel->listAllAdmin();

                        $totalItems = count($data['all_platform_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/blog/platform/') . 'page/(:num)';

                        $data['all_platform_data'] = array_slice($data['all_platform_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/platform', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'deleteplatform':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->blogPlatformModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Blog Platform Removed!']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting blog platform. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request']]);
                    }
                    break;
                case 'toggleplatformstatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivate':
                                if ($this->blogPlatformModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Platform marked In-active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking platform In-active. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivate':
                                if ($this->blogPlatformModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Platform marked active.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking platform active. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'addplatform':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processAddQuery') {
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'name' => [
                                'required' => true
                            ]
                        ]);

                        if ($valData->passed()) {
                            if ($this->blogPlatformModel->add([
                                        'name' => $_POST['name'],
                                        'status' => $_POST['status']
                                    ])) {
                                echo json_encode(['status' => 1, 'msg' => ['New Blog Platform Added!']]);
                            } else {
                                echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while adding new platform. Please try again later.']]);
                            }
                        } else {
                            echo json_encode(['status' => 0, 'msg' => $valData->errors()]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'add':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Create Post";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_blog_cat_data'] = $this->blogCategoryModel->listAll();
                    $data['all_blog_gen_data'] = $this->blogGenreModel->listAll();
                    $data['all_blog_platform_data'] = $this->blogPlatformModel->listAll();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/add', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'createpost':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Create Post";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_blog_cat_data'] = $this->blogCategoryModel->listAll();
                    $data['all_blog_gen_data'] = $this->blogGenreModel->listAll();
                    $data['all_blog_platform_data'] = $this->blogPlatformModel->listAll();

                    //Process New Post Request.
                    if (isset($_POST) && isset($_POST['createPost'])) {
                        $data['msg_type'] = "dark";
                        $data['msg_msg'] = "Something Went Wrong Please contact developer.";
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'title' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 35
                            ],
                            'description' => [
                                'required' => true,
                            ],
                            'summary' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 250
                            ],
                            'category' => [
                                'required' => true,
                            ],
                            'platform' => [
                                'required' => true,
                            ],
                            'genre' => [
                                'required' => true,
                            ],
                            'rating_price' => [
                                'required' => true,
                            ],
                            'rating_graphics' => [
                                'required' => true,
                            ],
                            'rating_difficulty' => [
                                'required' => true,
                            ],
                        ]);

                        if ($valData->passed()) {
                            //check image is attached or not
                            $imgResult = null;
                            if (!empty($_FILES['featuredImg']['name'])) {
                                //image attach.
                                $upload = new Upload($_FILES['featuredImg'], PUBLIC_ROOT . "/img/blog-big/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));
                                $imgResult = $upload->getResult();
                                $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                                if ($imgResult['type'] == 'success') {
                                    $imgPath = URL_ROOT . $realImgPath;
                                }
                            } else {
                                $imgPath = "";
                            }

                            if (!empty($imgPath)) {
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->add([
                                            'title' => $_POST['title'],
                                            'img' => json_encode($imgPath),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 1
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "New post created.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while creating new post. Please try again later.';
                                }
                            } elseif ($imgPath == "") {
                                //https://dummyimage.com/855x349/b000b0/fff.png&text=No+Preview+Available
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->add([
                                            'title' => $_POST['title'],
                                            'img' => json_encode("https://dummyimage.com/855x349/b000b0/fff.png&text=No+Preview+Available"),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 1
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "New post created.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while creating new post. Please try again later.';
                                }
                            } else {
                                $data['msg_type'] = "danger";
                                $data['msg_msg'] = $imgResult['message'];
                            }
                        } else {
                            $data['msg_type'] = "danger";
                            $data['msg_msg'] = $valData->errors();
                        }
                    } else if (isset($_POST) && $_POST['draftPost']) {
                        $data['msg_type'] = "dark";
                        $data['msg_msg'] = "Something Went Wrong Please contact developer.";
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'title' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 35
                            ],
                            'description' => [
                                'required' => true,
                            ],
                            'summary' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 250
                            ],
                            'category' => [
                                'required' => true,
                            ],
                            'platform' => [
                                'required' => true,
                            ],
                            'genre' => [
                                'required' => true,
                            ],
                            'rating_price' => [
                                'required' => true,
                            ],
                            'rating_graphics' => [
                                'required' => true,
                            ],
                            'rating_difficulty' => [
                                'required' => true,
                            ],
                        ]);

                        if ($valData->passed()) {
                            //check image is attached or not
                            $imgResult = null;
                            if (!empty($_FILES['featuredImg']['name'])) {
                                //image attach.
                                $upload = new Upload($_FILES['featuredImg'], PUBLIC_ROOT . "/img/blog-big/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));
                                $imgResult = $upload->getResult();
                                $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                                if ($imgResult['type'] == 'success') {
                                    $imgPath = URL_ROOT . $realImgPath;
                                }
                            } else {
                                $imgPath = "";
                            }

                            if (!empty($imgPath)) {
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->add([
                                            'title' => $_POST['title'],
                                            'img' => json_encode($imgPath),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 0
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "New post created.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while creating new post. Please try again later.';
                                }
                            } elseif ($imgPath == "") {
                                //https://dummyimage.com/855x349/b000b0/fff.png&text=No+Preview+Available
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->add([
                                            'title' => $_POST['title'],
                                            'img' => json_encode("https://dummyimage.com/855x349/b000b0/fff.png&text=No+Preview+Available"),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 0
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "New post created.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while creating new post. Please try again later.';
                                }
                            } else {
                                $data['msg_type'] = "danger";
                                $data['msg_msg'] = $imgResult['message'];
                            }
                        } else {
                            $data['msg_type'] = "danger";
                            $data['msg_msg'] = $valData->errors();
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/add', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'edit':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Edit Post";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_blog_cat_data'] = $this->blogCategoryModel->listAll();
                    $data['all_blog_gen_data'] = $this->blogGenreModel->listAll();
                    $data['all_blog_platform_data'] = $this->blogPlatformModel->listAll();
                    $data['blog_post_data'] = $this->blogPostModel->getByID($pagi);

                    if (!empty($data['blog_post_data'])) {
                        $this->view('admin/inc/header', $data);
                        $this->view('admin/inc/sidebar', $data);
                        $this->view('admin/blog/edit', $data);
                        $this->view('admin/inc/footer', $data);
                    } else {
                        Redirect::to(URL_ROOT . "admin/blog");
                    }
                    break;
                case 'editpost':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Edit Post";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_blog_cat_data'] = $this->blogCategoryModel->listAll();
                    $data['all_blog_gen_data'] = $this->blogGenreModel->listAll();
                    $data['all_blog_platform_data'] = $this->blogPlatformModel->listAll();

                    //Process New Post Request.
                    if (isset($_POST) && isset($_POST['editPost'])) {
                        $data['msg_type'] = "dark";
                        $data['msg_msg'] = "Something Went Wrong Please contact developer.";
                        $validator = new Validator();
                        $valData = $validator->validate($_POST, [
                            'title' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 35
                            ],
                            'description' => [
                                'required' => true,
                            ],
                            'summary' => [
                                'required' => true,
                                'min' => 5,
                                'max' => 250
                            ],
                            'category' => [
                                'required' => true,
                            ],
                            'platform' => [
                                'required' => true,
                            ],
                            'genre' => [
                                'required' => true,
                            ],
                            'rating_price' => [
                                'required' => true,
                            ],
                            'rating_graphics' => [
                                'required' => true,
                            ],
                            'rating_difficulty' => [
                                'required' => true,
                            ],
                        ]);

                        if ($valData->passed()) {
                            //check image is attached or not
                            $imgResult = null;
                            if (!empty($_FILES['featuredImg']['name'])) {
                                //image attach.
                                $upload = new Upload($_FILES['featuredImg'], PUBLIC_ROOT . "/img/blog-big/", (new Settings())->getValue('upload.max_size')->_val * 4096, explode(",", (new Settings())->getValue('upload.allowed_mime')->_val));
                                $imgResult = $upload->getResult();
                                $realImgPath = substr($imgResult['path'], strlen(PUBLIC_ROOT));
                                if ($imgResult['type'] == 'success') {
                                    $imgPath = URL_ROOT . $realImgPath;
                                }
                            } else {
                                $imgPath = "";
                            }

                            if (!empty($imgPath)) {
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->update($pagi, [
                                            'title' => $_POST['title'],
                                            'img' => json_encode($imgPath),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 1
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "Post Updated.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while creating new post. Please try again later.';
                                }
                            } elseif ($imgPath == "") {
                                //https://dummyimage.com/855x349/b000b0/fff.png&text=No+Preview+Available
                                $rating = array(
                                    "price" => $_POST['rating_price'],
                                    "graphics" => $_POST['rating_graphics'],
                                    "difficulty" => $_POST['rating_difficulty']
                                );
                                if ($this->blogPostModel->update($pagi, [
                                            'title' => $_POST['title'],
                                            'img' => json_encode($_POST['old_img']),
                                            'summery' => $_POST['summary'],
                                            'description' => $_POST['description'],
                                            'added_on' => date("Y-m-d H:i:s"),
                                            'cat' => $_POST['category'],
                                            'raiting' => json_encode($rating),
                                            'user' => Session::get('U_ID'),
                                            'platform' => $_POST['platform'],
                                            'genre' => $_POST['genre'],
                                            'featured' => $_POST['featured'],
                                            'status' => 1
                                        ])) {
                                    $data['msg_type'] = "success";
                                    $data['msg_msg'] = "Post Updated.";
                                } else {
                                    $data['msg_type'] = 'warning';
                                    $data['msg_msg'] = 'Something went wrong while updating post. Please try again later.';
                                }
                            } else {
                                $data['msg_type'] = "danger";
                                $data['msg_msg'] = $imgResult['message'];
                            }
                        } else {
                            $data['msg_type'] = "danger";
                            $data['msg_msg'] = $valData->errors();
                        }
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/edit', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                case 'deletepost':
                    if (isset($_POST) && $_POST['action'] == 'ajax_processDeleteQuery') {
                        if ($this->blogPostModel->delete($_POST['id'])) {
                            echo json_encode(['status' => 1, 'msg' => ['Blog Post Removed!']]);
                        } else {
                            echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while deleting blog post. Please try again later.']]);
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request']]);
                    }
                    break;
                case 'togglepoststatus':
                    if (isset($_POST)) {
                        switch (strtolower($_POST['action'])) {
                            case 'ajax_processinactivate':
                                if ($this->blogPostModel->update($_POST['id'], [
                                            'status' => 0
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Post marked draft.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking post draft. Please try again later']]);
                                }
                                break;
                            case 'ajax_processactivate':
                                if ($this->blogPostModel->update($_POST['id'], [
                                            'status' => 1
                                        ])) {
                                    echo json_encode(['status' => 1, 'msg' => ['Post marked published.']]);
                                } else {
                                    echo json_encode(['status' => 0, 'msg' => ['Something Went Wrong while marking post published. Please try again later']]);
                                }
                                break;
                            default:
                                echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                                break;
                        }
                    } else {
                        echo json_encode(['status' => 0, 'msg' => ['Invalid Request.']]);
                    }
                    break;
                case 'search':
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Search";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['search_query'] = $_POST['query'];

                    $data['all_blog_posts_data'] = $this->blogPostModel->search($_POST['query']);
                    

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/search', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    $data['page_title'] = SITE_NAME . "| Admin | Blog";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));

                    //Pagination
                    if ($pagi == 'page' && is_numeric($num)) {
                        $data['all_blog_posts_data'] = $this->blogPostModel->getAllAdmin();

                        $totalItems = count($data['all_blog_posts_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = $num;
                        $urlPattern = URL::baseURL('admin/blog/view/') . 'page/(:num)';

                        $data['all_blog_posts_data'] = array_slice($data['all_blog_posts_data'], ($num - 1) * $itemsPerPage, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    } else {
                        $data['all_blog_posts_data'] = $this->blogPostModel->getAllAdmin();

                        $totalItems = count($data['all_blog_posts_data']);
                        $itemsPerPage = $this->settingModel->getValue('pagination.perpage_admin')->_val;
                        $currentPage = 1;
                        $urlPattern = URL::baseURL('admin/blog/view/') . 'page/(:num)';

                        $data['all_blog_posts_data'] = array_slice($data['all_blog_posts_data'], 0, $itemsPerPage);

                        $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
                    }

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/index', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
            }
        } else {
            Redirect::to(URL_ROOT . 'admin/login');
        }
    }

    public function blogFilter() {
        if (!is_null($_POST['filter'])) {
            switch ($_POST['filter']) {
                case 1:
                    //show only active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Filter | Published Posts";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['filter_name'] = "Published Posts.";
                    $data['all_blog_posts_data'] = $this->blogPostModel->getAllPublished();


                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;

                case 2:
                    //show only in-active slider.
                    $data['page_title'] = SITE_NAME . "| Admin | Blog | Filter | Draft Posts";
                    $data['filter_name'] = "Draft Posts.";
                    $data['user_data'] = $this->userModel->data(Session::get('email'));
                    $data['all_blog_posts_data'] = $this->blogPostModel->getAllDraft();

                    $this->view('admin/inc/header', $data);
                    $this->view('admin/inc/sidebar', $data);
                    $this->view('admin/blog/filter', $data);
                    $this->view('admin/inc/footer', $data);
                    break;
                default:
                    echo "Invalid Filter.";
                    break;
            }
        } else {
            echo "Invalid Filter.";
        }
    }

}
