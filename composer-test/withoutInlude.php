<?php

# spl: standard php library
# __autoload: 1) spl_autoload_register  2) class

spl_autoload_register(function($class){

});



//这里主要是PHPSTORM太厉害，他能直接给你找到这个类，并且也不会有任何warning
src\User::sayHi();

exit(0);

