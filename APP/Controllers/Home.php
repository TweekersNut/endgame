<?php

namespace APP\Controllers;

use APP\Helpers\IP as IP;
use APP\Core\Redirect as Redirect;

class Home extends \APP\Core\Controller {

    private $sliderModel;
    private $userModel;
    private $blogPostModel;
    private $blogGenreModel;
    private $blogCatModel;
    private $advertsModel;

    function __construct() {
        $this->sliderModel = $this->model('Sliders');
        $this->blogPostModel = $this->model('Blog\Posts');
        $this->userModel = $this->model('Users');
        $this->blogGenreModel = $this->model('Blog\Genre');
        $this->blogCatModel = $this->model('Blog\Category');
        $this->advertsModel = $this->model('Adverts');

        //Check for admin account if not present create it.
        if ($this->userModel->find('admin') == false) {
            //create admin account.
            if ($this->userModel->add([
                        'username' => 'admin',
                        'email' => 'admin@tweekersnut.com',
                        'password' => encrypt('Qwerty@1234'),
                        'avatar' => URL_ROOT . 'img/blank_avatar.png',
                        'added_on' => date("Y-m-d H:i:s"),
                        'IP' => IP::getIP(),
                        'acc_key' => generateRandomKey(),
                        'status' => 1
                    ])) {
                //log user created.
                echo "<script>console.log('Admin User Created')</script>";
            }
        }
    }

    public function index() {
        if (USE_SSL == true) {
            if (!isSSL()) {
                if (empty($_SERVER['HTTPS'])) {
                    Redirect::to(URL_ROOT);
                }
            }
        }

        $data['page_title'] = "Home | " . SITE_NAME;
        $data['slider_data'] = $this->sliderModel->listAll();
        $data['featured_posts'] = $this->blogPostModel->getFeaturePosts();
        $data['latest_posts'] = $this->blogPostModel->getLatest(5);
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['blog_featured_posts_data'] = ($this->blogPostModel->getFeaturedPosts((int) $this->blogCatModel->exists('games'))) ? $this->blogPostModel->getFeaturedPosts((int) $this->blogCatModel->exists('games')) : null;
        $data['video_slider'] = $this->sliderModel->getVideoSliders();
        $data['adverts_banners'] = $this->advertsModel->listAll('home');

        $this->view('inc/header', $data);
        $this->view('home/index', $data);
        $this->view('inc/footer', $data);
    }

}
