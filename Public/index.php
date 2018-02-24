<?php

#定义resetful 的模块名称
define( "RESETFUL_MODULE_NAME", "ResetFul" );

define( "APPLICATION_PATH", dirname( dirname( __FILE__ ) ) );
$app = new \Syx\Application( APPLICATION_PATH . "/Conf/application.ini" );
$app->bootstrap()//call bootstrap methods defined in Bootstrap.php
->run();