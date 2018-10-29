<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

//框架入口文件
require __DIR__ . '/BaseYii.php';

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{
}

//注册spl 的 autoload，用 yii 的 autoload 方法，很尴尬，因为 yii 开发的时候难道没有
//composer 吗，其实也有啊，不然框架提到了composer,但是这为啥特么还用自己写的
spl_autoload_register(['Yii', 'autoload'], true, true);

//yii 本身自动加载的，
Yii::$classMap = require __DIR__ . '/classes.php';

Yii::$container = new yii\di\Container();


//执行完 yii 的初始化之后，开始application ->run
