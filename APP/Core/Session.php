<?php
namespace APP\Core;

class Session
{

    public static function exists($key)
    {
        return (isset($_SESSION[$key])) ? true : false;
    }


    public static function insert($key, $val)
    {
        return $_SESSION[$key] = $val;
    }


    public static function get($key)
    {
        return $_SESSION[$key];
    }


    public static function del($key)
    {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }


    public static function flash($key, $val = '')
    {
        if (self::exists($key)) {
            $session = self::get($key);
            self::del($key);
            return $session;
        } else {
            self::insert($key, $val);
        }
    }
}
