<?php
include("common.php");


$link = db_connect();
$projectID = mysqli_real_escape_string($link,$_REQUEST['projectID']);
$personID = mysqli_real_escape_string($link, $_REQUEST['personID']);


$sql = "INSERT INTO Person_has_Project (Person_idPerson, Project_idProject) VALUES (?, ?)";
$stmt = mysqli_prepare($link, $sql) or die($link->error);
mysqli_stmt_bind_param($stmt, "ii", $personID, $projectID) or die();
mysqli_stmt_execute($stmt) or die("failed to execute");
$result = mysqli_stmt_get_result($stmt);

echo "succesfully added user";


?>