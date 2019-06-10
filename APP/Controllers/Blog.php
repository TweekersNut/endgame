<?php

namespace APP\Controllers;

use APP\Core\Validator as Validator;
use APP\Core\Mailer as Mailer;
use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Helpers\Pagination as Pagi;
use APP\Models\Settings as Settings;
use APP\Core\Redirect as Redirect;

class Blog extends \APP\Core\Controller {

    private $settingsModel;
    private $blogCatModel;
    private $blogPostModel;
    private $blogPlatformModel;
    private $blogGenreModel;
    private $usersModel;
    private $settings;
    private $advertsModel;

    function __construct() {
        $this->settingsModel = $this->model('Settings');
        $this->blogCatModel = $this->model('Blog\Category');
        $this->blogPostModel = $this->model('Blog\Posts');
        $this->blogPlatformModel = $this->model('Blog\Platform');
        $this->blogGenreModel = $this->model('Blog\Genre');
        $this->usersModel = $this->model('Users');
        $this->settings = new Settings;
        $this->advertsModel = $this->model('Adverts');
    }

    public function index($pagi = null, $num = null) {

        $data['page_title'] = "Blog | Index | " . SITE_NAME;
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        if ($pagi == 'page' && is_numeric($num)) {
            $data['blog_posts_data'] = $this->blogPostModel->getAll();

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = $num;
            $urlPattern = URL::baseURL('blog/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], ($num - 1) * $itemsPerPage,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        } else {
            $data['blog_posts_data'] = $this->blogPostModel->getAll();

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = 1;
            $urlPattern = URL::baseURL('blog/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], 0,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        }

        $this->view('inc/header', $data);
        $this->view('blog/blog', $data);
        $this->view('inc/footer', $data);
    }

    public function games($pagi = null, $num = null) {
        $checkGamesCat = $this->blogCatModel->exists('games');

        if ($checkGamesCat == false) {
            $this->blogCatModel->add([
                'name' => ucfirst('Games'),
                'desc' => 'Games Category Created By Bot.',
                'status' => 1
            ]);
        }

        $data['page_title'] = "Blog | Games | " . SITE_NAME;
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['blog_featured_posts_data'] = ($this->blogPostModel->getFeaturedPosts((int) $this->blogCatModel->exists('games'))) ? $this->blogPostModel->getFeaturedPosts((int) $this->blogCatModel->exists('games')) : null;
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        if ($pagi == 'page' && is_numeric($num)) {
            $data['blog_posts_data'] = $this->blogPostModel->listAllByCat((int) $this->blogCatModel->exists('games'));

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = $num;
            $urlPattern = URL::baseURL('blog/games/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], ($num - 1) * $itemsPerPage,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        } else {
            $data['blog_posts_data'] = $this->blogPostModel->listAllByCat((int) $this->blogCatModel->exists('games'));

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = 1;
            $urlPattern = URL::baseURL('blog/games/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], 0,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        }

        $this->view('inc/header', $data);
        $this->view('blog/games', $data);
        $this->view('inc/footer', $data);
    }

    public function reviews($pagi = null, $num = null) {
        echo  $this->settings->getValue('pagination.review')->_val;
        $checkGamesCat = $this->blogCatModel->exists('reviews');

        if ($checkGamesCat == false) {
            $this->blogCatModel->add([
                'name' => ucfirst('reviews'),
                'desc' => 'Reviews Category Created By Bot.',
                'status' => 1
            ]);
        }
        $data['page_title'] = "Blog | Reviews | " . SITE_NAME;

        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        
        if ($pagi == 'page' && is_numeric($num)) {
            $data['blog_posts_data'] = $this->blogPostModel->listAllByCat((int) $this->blogCatModel->exists('reviews'));

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = $num;
            $urlPattern = URL::baseURL('blog/reviews/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], ($num - 1) * $itemsPerPage,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        } else {
            $data['blog_posts_data'] = $this->blogPostModel->listAllByCat((int) $this->blogCatModel->exists('reviews'));

            $totalItems = count($data['blog_posts_data']);
            $itemsPerPage = $this->settings->getValue('pagination.perpage')->_val;
            $currentPage = 1;
            $urlPattern = URL::baseURL('blog/reviews/') . 'page/(:num)';
            
            $data['blog_posts_data'] = array_slice($data['blog_posts_data'], 0,$itemsPerPage);

            $data['paginator'] = new Pagi($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        }
        $this->view('inc/header', $data);
        $this->view('blog/reviews', $data);
        $this->view('inc/footer', $data);
    }

    public function genre($genName) {
        $data['page_title'] = "Blog | Genre " . strtoupper($genName) . " | " . SITE_NAME;
        $data['gen_name'] = strtoupper($genName);
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['blog_posts_data'] = $this->blogPostModel->getByGenre($genName);
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        $this->view('inc/header', $data);
        $this->view('blog/filter/genre', $data);
        $this->view('inc/footer', $data);
    }

    public function category($catName) {
        $data['page_title'] = "Blog | Genre " . $catName . " | " . SITE_NAME;
        $data['cat_name'] = $catName;
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['blog_posts_data'] = $this->blogPostModel->listAllByCat((int) $this->blogCatModel->exists($catName));
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        $this->view('inc/header', $data);
        $this->view('blog/filter/category', $data);
        $this->view('inc/footer', $data);
    }

    public function platform($platName) {
        $data['page_title'] = "Blog | Genre " . $platName . " | " . SITE_NAME;
        $data['plat_name'] = $platName;
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['blog_posts_data'] = $this->blogPostModel->getByPlatform($platName);
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        $this->view('inc/header', $data);
        $this->view('blog/filter/platform', $data);
        $this->view('inc/footer', $data);
    }

    public function search() {
        if (isset($_POST['post_title'])) {
            $data['page_title'] = "Blog | Search " . $_POST['post_title'] . " | " . SITE_NAME;
            $data['search_name'] = $_POST['post_title'];
            $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
            $data['platform_data'] = $this->blogPlatformModel->listAll();
            $data['genre_data'] = $this->blogGenreModel->listAll();
            $data['blog_posts_data'] = $this->blogPostModel->search($_POST['post_title']);
            $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
            $data['adverts_banners'] = $this->advertsModel->listAll('blog');
            
            $this->view('inc/header', $data);
            $this->view('blog/filter/search', $data);
            $this->view('inc/footer', $data);
        } else {
            URL::baseURL("blog/index");
        }
    }

    public function read($id) {
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['blog_post_data'] = $this->blogPostModel->getByID((int) $id);
        $data['page_title'] = "Blog | View " . $data['blog_post_data']->title . " | " . SITE_NAME;
        $data['user_data'] = $this->usersModel->data($data['blog_post_data']->user);

        if(!empty($data['blog_post_data'])){
            $this->view('inc/header', $data);
            $this->view('blog/read', $data);
            $this->view('inc/footer', $data);
        }else{
            Redirect::to(URL_ROOT . "blog");
        }
    }
    
    public function filter($arg){
        $data['page_title'] = "Blog | Filter : " . strtoupper($arg) . " | " . SITE_NAME;
        $data['blog_sidebar_cat_data'] = $this->blogCatModel->listAll();
        $data['platform_data'] = $this->blogPlatformModel->listAll();
        $data['genre_data'] = $this->blogGenreModel->listAll();
        $data['filter'] = $arg;
        $data['blog_posts_data'] = $this->blogPostModel->getByLetter($arg);
        $data['trending_posts_data'] = $this->blogPostModel->getTrendingPosts();
        $data['adverts_banners'] = $this->advertsModel->listAll('blog');
        
        $this->view('inc/header', $data);
        $this->view('blog/filter/letter', $data);
        $this->view('inc/footer', $data);
    }

}
