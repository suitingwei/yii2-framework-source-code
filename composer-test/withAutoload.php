<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/26
 * Time: 17:24
 */

//注册自动加载
spl_autoload_register(function($class){
    //最简单的autoload,部分遵守了PSR-0,把 namespace 和 filePath互换而已
    $filePath = strtr($class,'\\',DIRECTORY_SEPARATOR) .'.php';
    
    if(file_exists($filePath)){
        include $filePath;
        return true;
    }
    return false;
});

//这里主要是PHPSTORM太厉害，他能直接给你找到这个类，并且也不会有任何warning
src\User::sayHi();

exit(0);

