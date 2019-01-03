<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/25
 * Time: 10:30
 */
namespace app\modules\user\controllers;

use yii\web\Controller;

class DBController extends Controller
{
    
    public function actionLogin()
    {
        $this->log();
        
        return '[module:user][controller:auth][action:login]';
    }
    
}

