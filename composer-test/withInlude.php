<?php
//手动指定这个 Class 的目录
include "./src/User.php";

//这里主要是PHPSTORM太厉害，他能直接给你找到这个类，并且也不会有任何warning
\src\User::sayHi();

exit(0);

