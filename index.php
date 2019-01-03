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
    /**
     * 位于bootstrap配置的所有组件都会在整个application初始化完毕之后
     * 进行引导。这个所谓的引导就是把这些组件进行实例化,因为components中的
     * 所有的配置对象只会加载到applications的数组中，并不会进行实例创建。
     */
    'bootstrap'  => ['log'],
    'components' => [
        'log'        => [
            'flushInterval'=>1,
            'targets' => [
                'file' => [
                    'class'      => 'yii\log\FileTarget',
                    'levels'     => ['trace', 'info'],
                    'categories' => ['yii\*'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
            'rules'               => [
                // ...
            ],
        ],
        'tutu'=> [
            'class' => \app\modules\user\controllers\Test::class
        ]
    ],
    
    /**
     * modules 是在application::__construct的时候通过
     * Yii::configure($config);这个方法注入到了$application的属性里，同时这也触发了
     * Application继承的Module的魔术方法 __set,最终调用了 module的setModules()方法
     * 然后把这个配置数组的所有模块加载，不过这个时候是懒加载的，并没有进行对象的创建。
     * 只有当进行 `handleRequest`的时候，才会根据解析的 URL 来选择创建对应的 module，
     * 之后使用这个module来创建对应的 controller 进行请求的处理。
     */
    'modules' => [
        'user' =>[
            'class' => 'app\modules\user\UserModule'
        ]
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
    
    $request = $application->getRequest();

    $application->handleRequest($request);

    return $application->run();
} catch (\Exception $exception) {
    \helpers\HtmlHelper::renderException($exception);
}




