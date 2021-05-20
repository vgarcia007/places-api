<?php

define('APP_DEBUG', getenv('APP_DEBUG') ); 

define('DBC_STRING', getenv('DB_DSN') );
define('DB_PASS', getenv('DB_PASSWORD') );
define('DB_USER', getenv('DB_USER') );

define('APP_SECRET', getenv('APP_SECRET') ); 

define('RESTAURANT_ID', getenv('RESTAURANT_ID') ); 
define('APP_TABLES', getenv('APP_TABLES') ); 
define('APP_DOMAIN', getenv('APP_DOMAIN') ); 

define('APP_TRANSLATE', array(
    'Sunday'=>'Sonntag',
    'Monday'=>'Montag',
    'Tuesday'=>'Dienstag',
    'Wednesday'=>'Mittwoch',
    'Thursday'=>'Donnerstag',
    'Friday'=>'Freitag',
    'Saturday'=>'Samstag'
) ); 

?>