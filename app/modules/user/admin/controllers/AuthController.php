<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/25
 * Time: 10:30
 */
namespace app\modules\user\admin\controllers;

use yii\web\Controller;

class AuthController extends Controller{
    
    public function actionLogin()
    {
        return '[module:user|admin][controller:auth][action:login]';
    }
}