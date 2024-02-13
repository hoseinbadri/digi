<?php
// https://api.digikala.com/v1/search/?q=intel/2
// https://api.digikala.com/v1/categories/electronic-devices/
// https://sirius.digikala.com/v1/brand/29/?page=3
// error_reporting(0);
set_time_limit(0);
session_start();

define('BaseUrl' , 'https://sirius.digikala.com/v1/');


define('DBHost', 'localhost');
define('DBUser', 'root');
define('DBPass', '');
define('DBName', 'digi');


$link = mysqli_connect(DBHost, DBUser, DBPass, DBName);

if(mysqli_errno($link)) {
    die(mysqli_error($link));
}

require_once('functions.php');
