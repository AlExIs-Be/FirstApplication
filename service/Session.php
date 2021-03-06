<?php
abstract class Session
{
    public static function add($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function remove($key){
        unset($_SESSION[$key]);
    }
    /**
     * @return int|null $key
     */
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }
}