<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/26
 * Time: 17:24
 */

// 试着注释或者解开这行代码，看一看 namespace 有没有用
// 这一行是怎么影响autoload的
namespace src;

class User
{
    public static function sayHi()
    {
       echo "Hi!\n" ;
    }
}