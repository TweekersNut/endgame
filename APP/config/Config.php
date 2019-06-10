<?php

//Db Params
define('DB_HOST','localhost');
define('DB_DB',''); // enter database name
define('DB_USER',''); // enter your db user.
define('DB_PASS','');//enter your database password.

//APP Config
define('APP_ROOT',dirname(dirname(__FILE__)));
define('ROOT',dirname(dirname(dirname(__FILE__))));
define('PUBLIC_ROOT',dirname(dirname(dirname(__FILE__)))."/public");
define('URL_ROOT',"https://www.tweekersnut-tutorial.ml/");
define('SITE_NAME','End Game');
define('USE_SSL',true);

define('DEFAULT_CONTROLLER','Home');
define('DEFAULT_METHOD','index');

//Encryption Key
define('ENC_KEY','CKXH2U9RPY3EFD70TLS1ZG4N8WQBOVI6AMJ5');

define('TIME_ZONE','Asia/Kolkata');
