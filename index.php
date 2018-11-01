<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/11/1
 * Time: 11:06
 */


require __DIR__.'/vendor/autoload.php';

class Foo extends  \yii\base\Component{
    
    const EVENT_INIT = 'init';
}

$foo = new Foo;

$foo->on(Foo::EVENT_INIT,function($event){
   echo "the foo class's init event has been triggered!" .PHP_EOL;
});

$foo->on(Foo::EVENT_INIT,function($event){
  echo "the second event has been triggered!\n"  ;
});


$foo->trigger(Foo::EVENT_INIT);
