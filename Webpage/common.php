<?php
    function db_connect(){ //function to return link to database
        $hostname = 'capstonemysql.c28yoaboirju.us-west-2.rds.amazonaws.com';                                                         //deleted all data for turn it.
        $username = 'managementSystem';
        $password = '6d02b4s2F32L90';
        $database = 'managementDatabase';
        $mysqli = new mysqli($hostname, $username, $password, $database) or die("failed to connect to server");
        return $mysqli;
    }
?>