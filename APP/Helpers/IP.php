<?php

namespace APP\Helpers;

class IP
{
    public static function getIP()
    {
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
        if (array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $IP = $headers['X-Forwarded-For'];
        } else if (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['X-HTTP_X_FORWARDED_FOR-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $IP = $headers['HTTP_X_FORWARDED_FOR'];
        } else {
            $IP = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        }
        return $IP;
    }
    
    public static function lookup($ip = null){
        if(!is_null($ip)){
            $user_ip = $ip;
            $ipData = json_decode(file_get_contents("http://extreme-ip-lookup.com/json/$user_ip"));
            return $ipData;
        }
        return false;
    }
}
