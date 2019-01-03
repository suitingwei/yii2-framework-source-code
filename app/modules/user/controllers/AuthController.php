<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/25
 * Time: 10:30
 */

namespace app\modules\user\controllers;

use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\db\Exception;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        try {
            return $this->testMultipleConnections();
//            return $this->testSingleConnection();
        } catch (InvalidConfigException $e) {
            die($e);
        } catch (Exception $e) {
            die($e);
        }
    }
    
    /**
     * 测试多个数据库连接
     *
     * @throws InvalidConfigException
     */
    private function testMultipleConnections()
    {
        /**
         * dsn,username,password都是直接赋予了connection的属性
         */
        $dbConfig = [
            'masterConfig' => [
                'username' => 'wordpress',
                'password' => '',
            ],
            'masters'      => [
                ['dsn' => 'mysql:host=localhost;dbname=wordpress;port=3306',],
                ['dsn' => 'mysql:host=localhost;dbname=wordpress;port=3306',]
            ],
            'slaveConfig'  => [
                'username' => 'wordpress',
                'password' => '',
            ],
            'slaves'       => [
                ['dsn' => 'mysql:host=localhost;dbname=wordpress;port=3306',],
                ['dsn' => 'mysql:host=localhost;dbname=wordpress;port=3306',],
                ['dsn' => 'mysql:host=localhost;dbname=wordpress;port=3306',],
            ],
        ];
        
        //创建connection对象，这个对象表示的是一个连接，他是可以做到读写分离,
        //负载均衡的,在创建之后，这个链接其实还没有open。在 ORM 中是由command
        //对象去查询的时候，才会触发 connection 的链接
        $connection             = new Connection($dbConfig);
        $originSlaveConnection  = $connection->getSlaveAttribute();
        $originMasterConnection = $connection->getMasterAttribute();
        echo "The origin connection is :" . (is_object($connection) ? spl_object_id($connection) : 0) . PHP_EOL;
        echo "The origin master connection is :" . (is_object($originMasterConnection) ? spl_object_id($originMasterConnection) : 0) . PHP_EOL;
        echo "The origin slave connection is :" . (is_object($originSlaveConnection) ? spl_object_id($originSlaveConnection) : 0) . PHP_EOL;
        
        $slaveConnection  = $connection->getSlave();
        $masterConnection = $connection->getMaster();
        echo "The current master connection is :" . (is_object($masterConnection) ? spl_object_id($masterConnection) : 0) . PHP_EOL;
        echo "The current slave connection is :" . (is_object($slaveConnection) ? spl_object_id($slaveConnection) : 0) . PHP_EOL;
        
        var_dump($slaveConnection->pdo);
        var_dump($slaveConnection->slavePdo);
        var_dump($slaveConnection->masterPdo);
        
        var_dump($masterConnection->pdo);
        var_dump($masterConnection->slavePdo);
        var_dump($masterConnection->masterPdo);
    }
    
    /**
     * 测试单独的一个 DSN 配置的数据库连接
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    private function testSingleConnection()
    {
        /**
         * dsn,username,password都是直接赋予了connection的属性
         */
        $dbConfig = [
            'username'        => 'wordpress',
            'password'        => '',
            'dsn'             => 'mysql:host=localhost;dbname=wordpress;port=3306',
            'enableProfiling' => true
        ];
        
        //创建connection对象，这个对象表示的是一个连接，他是可以做到读写分离,
        //负载均衡的,在创建之后，这个链接其实还没有open。在 ORM 中是由command
        //对象去查询的时候，才会触发 connection 的链接
        $connection = new Connection($dbConfig);
        $connection->on(Connection::EVENT_AFTER_OPEN, function () {
            echo "The database connection has been opened!\n";
        });
        $connection->open();
        var_dump(spl_object_id($connection));
    }
    
    /**
     * @return false|string
     * @throws Exception
     * @throws InvalidConfigException
     */
    private function testCommand()
    {
        $dbConfig = [
            'dsn'      => 'mysql:host=localhost;dbname=wordpress;port=3306',
            'username' => 'wordpress',
            'password' => '',
        ];
        
        //创建connection对象，这个对象表示的是一个连接，他是可以做到读写分离,
        //负载均衡的,在创建之后，这个链接其实还没有open。在 ORM 中是由command
        //对象去查询的时候，才会触发 connection 的链接
        $connection = new Connection($dbConfig);
        $connection->open();
        $command = $connection->createCommand('select post_title from wp_posts');
        $result  = $command->queryAll();
        
        return json_encode($result);
    }
}