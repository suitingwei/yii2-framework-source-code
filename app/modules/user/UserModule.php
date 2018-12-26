<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/25
 * Time: 10:30
 */

namespace app\modules\user;

use yii\base\Module;

class UserModule extends Module
{
    public function init()
    {
        parent::init();
        $this->modules= [
            'admin' => 'app\modules\user\admin\AdminModule'
        ];
    }
}