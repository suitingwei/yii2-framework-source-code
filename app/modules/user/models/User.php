<?php

namespace app\modules\user\models;

use yii\db\ActiveRecord;

class User extends  ActiveRecord {
    public static function getDb()
    {
       return \Yii::$app->get('db') ;
   }
    
    public static function tableName()
    {
    return 'wp_posts'    ;
   }
}
