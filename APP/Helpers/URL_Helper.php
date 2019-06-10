<?php

namespace APP\Helpers;

class URL_Helper{
	
	public static function addOrUpdateUrlParam($name, $value) {
		$params = $_GET;
		unset($params[$name]);
		$params[$name] = $value;
		return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
	}

	public static function baseURL($url){
		return URL_ROOT . $url;
	}
        
        public static function check($url){
            if(($_GET['url'] == $url)){
                return true;
            }
            return false;
        }
}