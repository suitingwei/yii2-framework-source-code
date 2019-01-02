<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/25
 * Time: 10:30
 */
namespace app\modules\user\controllers;

use yii\web\Controller;

class AuthController extends Controller{
    
    public function actionLogin()
    {
        $this->log();
        return '[module:user][controller:auth][action:login]';
    }
    
    private function log()
    {
        $fp = fopen('/tmp/test.log','a+');
        
        if(flock($fp,LOCK_EX) === false){
           return false;
        }
        $this->write($fp);
        
        flock($fp,LOCK_UN);
    }
    
    private function write($fp)
    {
        $pid = posix_getpid();
        for($i=0;$i<100;$i++){
            fwrite($fp, sprintf("pid=%s,i=%s\n",$pid,$i));
        }
    }
}