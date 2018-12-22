<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/11/1
 * Time: 11:06
 */


require __DIR__.'/vendor/autoload.php';

require(__DIR__ . '/framework/Yii.php');


$config = [
    'id' => uniqid('yii-application'),
    'basePath' => __DIR__,
    'components' => [
       'qwe'  => function(){
            return 'qwe';
       }
    ]
];

try{
    
    $application =  new \yii\web\Application($config);
    
    $request  =  $application->getRequest();
    
    $application->handleRequest($request);
    return $application->run();
}

catch (\Exception $exception){
    \helpers\HtmlHelper::renderException($exception);
}
