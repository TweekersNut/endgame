# EndGame Gaming Website

Endgame is a contemporary free games website that will help you quick-start your gaming project. It is an ideal for making gaming blogs and review websites due to the highly adaptive and fully customizable web design. Endgame is also based on Bootstrap Framework what ensures flexibility and mobile-readiness. Meaning, your final game-packed website will work seamlessly on all devices, from mobile phones and up to desktop computers. Indeed, Endgame is also compatible with retina screens and modern web browsers.

## Live Preview
[Check Live Working](https://tweekersnut-tutorial.ml)

## Getting Started

It is easy to setup endgame website on live server or localhost. We have used M.V.C(Model View Controller) approach. Whole website is using one configuration file name as ``` config.php ``` located in ``` APP/Config/Config.php ``` directory. 
Configuration file have some defined constants which will be used by website.

``` Example Configuration File
//Database Parameters
define('DB_HOST','localhost');
define('DB_DB','DATABASE NAME');
define('DB_USER','DATABASE USERNAME');
define('DB_PASS','DATABASE PASSWORD');

//Application Config
define('APP_ROOT',dirname(dirname(__FILE__))); // Dynamic no need to change
define('ROOT',dirname(dirname(dirname(__FILE__)))); // Dynamic no need to change
define('PUBLIC_ROOT',dirname(dirname(dirname(__FILE__)))."/public"); //Dynamic no need to change
define('URL_ROOT',"YOUR DOMAIN NAME");
define('SITE_NAME','YOUR SITE NAME');
define('USE_SSL',true); // True = use HTTPS || False = use HTTP

define('DEFAULT_CONTROLLER','Home'); // Default Controller
define('DEFAULT_METHOD','index'); // Default Method

//Encryption Key
define('ENC_KEY','CKXH2U9RPY3EFD70TLS1ZG4N8WQBOVI6AMJ5'); //Random Encryption key

define('TIME_ZONE','Asia/Kolkata'); // Set timezone according to your needs
```

### Prerequisites
Requirements to run website
1. PHP v7.0+ Server
2. MariaDB
3. Mod_rewrite extension enable.
4. .ht* files allowed.

### Installing
Installation of the website is very easy. <br />
Step 1) Download files. <br />
Step 2) Unzip file in directory. <br />
Step 3) Move all the files to your live server or localhost (www/htdocs Directory) || WAMP & XAMPP Respectively. <br />
Step 4) Update Configuration file present at ```APP/Config/Config.php``` according to your needs. You can check above configuration file.<br />
Step 5) Open PHPMYADMIN or anyclient you using and upload sql file located at ```APP/SQLDump/structure.sql```.<br />
Step 6) Visit your url and enjoy.<br />

## Deployment

Video Coming Soon!

## Built With
[TweekersNut Network MVC 1.0](https://tweekersnut.com/) - Framework <br />
[MySQL](https://mysql.com) - Database <br />
[Bootstrap](https://getbootstrap.com/) - HTML & CSS framework <br />

## Troubleshooting

If package works but its using ```/public/home/index``` then you can create a .htaccess file given below in the root dir and use it.
```
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]
```
This will map the ```/public``` folder request in the url auto and help you get good S.E.O friendly URL.

## Bug Reporting

Endgame got dedicated special section inbuilt in administrator panel to quickly report for bug. All bug requests are directly sent to the developers. Every bug query will be first verified and then patch for the bug will be realesed ASAP.

<a href="https://ibb.co/mJPWf47"><img src="https://i.ibb.co/WnRJmf1/bug-report.png" alt="bug-report" border="0"></a>

## Feature Request

Our developers are ready to build any custom feature you want for your website. ```Example store,cart,review system``` and etc. can be build for each specific customer according to there needs. All feature requests are paid request. You will be chanrged one time fee to develop the specific feature for your website. To post your custom requests Endgame website got built in request feature section in administration section.

<a href="https://ibb.co/RSfPdYT"><img src="https://i.ibb.co/KGd7Sbx/request-new-feature.png" alt="request-new-feature" border="0"></a>

## Authors
[Taranpreet Singh Rayat](https://taranpreetsingh.com/) <br />
[Facebook](https://www.facebook.com/taranpreet126) <br />

## License

This project is licensed under the GNU Public V3 License - see the [LICENSE.md](LICENSE) file for details
