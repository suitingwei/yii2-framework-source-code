<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/11/1
 * Time: 11:06
 */


//常量是不能够重复定义的，第二次调用是废的、
define('YII_DEBUG', true);

require __DIR__ . '/vendor/autoload.php';

require(__DIR__ . '/framework/Yii.php');


$config = [
    'id'         => uniqid('yii-application'),
    'basePath'   => __DIR__,
//    'bootstrap' => ['log'],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
            'rules'               => [
                // ...
            ],
        ],
    ],
];

//set_exception_handler(function($exception){
//    echo (string) $exception;die('exception handler');
//});
//
//set_error_handler(function($error,$message,$file,$line){
//    var_dump($error,$message,$file,$line);
//
//});

try {

    $application = new \yii\web\Application($config);

    var_dump($application->has('log',true));
    var_dump($application->has('request',true));
    var_dump($application->has('response',true));
    var_dump($application->has('formatter',true));
    var_dump($application->has('view',true));
    var_dump($application->has('urlManager',true));

//    $request = $application->getRequest();
//
//    $application->handleRequest($request);
//
//    return $application->run();
} catch (\Exception $exception) {
    \helpers\HtmlHelper::renderException($exception);
}
