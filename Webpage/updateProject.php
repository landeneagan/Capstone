<?php
include("common.php");



$link = db_connect();
$projectID = mysqli_real_escape_string($link,$_REQUEST['projectID']);
$projectName = mysqli_real_escape_string($link,$_REQUEST['name']);
$startDate = mysqli_real_escape_string($link, $_REQUEST['startDate']);
$endDate = mysqli_real_escape_string($link,$_REQUEST['endDate']);
$description = mysqli_real_escape_string($link, $_REQUEST['description']);

    $link = db_connect();
                mysqli_report(MYSQLI_REPORT_ALL);

                $sql = "UPDATE Project SET name = ?, startDate = ?, endDate = ?, description = ? WHERE idProject =".$projectID;
                $stmt = mysqli_prepare($link, $sql) or die($link->error);
                mysqli_stmt_bind_param($stmt, "ssss", $projectName, $startDate, $endDate, $description) or die();
                mysqli_stmt_execute($stmt) or die("failed to execute");
                $projectID = mysqli_insert_id($link);
                $result = mysqli_stmt_get_result($stmt);



?>