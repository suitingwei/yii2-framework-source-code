<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/3
 * Time: 21:21
 */


$arr = [];
//unix socket, tcp
for ($i = 0; $i<100;$i++){
    $arr[] = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
}

sleep(10);
foreach ($arr as $key => &$item) {
    if($key <=50 ){
        
        $item =null;
    }
}

sleep(100);
