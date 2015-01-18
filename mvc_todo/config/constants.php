<?php 

define('URL', 'http://' . dirname ( dirname( $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ) ) );
define('SERVER_ROOT', dirname( dirname ( __FILE__ ) ));

//not in use yet
define( 'SYS_FOLDER', SERVER_ROOT . DIRECTORY_SEPARATOR.'framework'. DIRECTORY_SEPARATOR.'system'. DIRECTORY_SEPARATOR );
define( 'APP_FOLDER', SERVER_ROOT . DIRECTORY_SEPARATOR.'framework'. DIRECTORY_SEPARATOR.'app'. DIRECTORY_SEPARATOR );


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'todoMVC');
define('DB_USER', 'jolita');
define('DB_PASS', 'zN6br4fLYVJ8pSNy');


 ?>


