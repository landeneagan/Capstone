<?php  
//    define('DB_SERVER', 'localhost:3036');
    define('DB_SERVER', 'capstonemysql.c28yoaboirju.us-west-2.rds.amazonaws.com');
    define('DB_USERNAME', 'managementSystem');
    define('DB_PASSWORD', '6d02b4s2F32L90');
    define('DB_DATABASE', 'managementDatabase');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>