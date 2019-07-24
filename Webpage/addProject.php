<?php
include("common.php");



    echo "<th>name</th>";
    echo "<th>Start Date</th>";
    echo "<th>End Date</th>";
    echo "<th>Description</th>";
    echo "<th>Leader</th>";
    echo "<th>Members</th>";
    echo "<th>Action</th>";



$link = db_connect();
$projectName = mysqli_real_escape_string($link,$_REQUEST['projectName']);
$leader = mysqli_real_escape_string($link, $_REQUEST['leader']);
$date = date("Y-m-d");

	if ($projectName !== "" || $leader !== "") {
    $link = db_connect();
    		echo "for inserting";
                mysqli_report(MYSQLI_REPORT_ALL);

                $sql = "INSERT INTO Project (name, Person_idPerson, startDate) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($link, $sql) or die($link->error);
                mysqli_stmt_bind_param($stmt, "sis", $projectName, $leader, $date) or die();
                mysqli_stmt_execute($stmt) or die("failed to execute");
                $projectID = mysqli_insert_id($link);
                $result = mysqli_stmt_get_result($stmt);




                $sql = "INSERT INTO Person_has_Project (Person_idPerson, Project_idProject) VALUES (?, ?)";
                $stmt = mysqli_prepare($link, $sql) or die($link->error);
                mysqli_stmt_bind_param($stmt, "ii", $leader, $projectID) or die();
                mysqli_stmt_execute($stmt) or die("failed to execute");
                $result = mysqli_stmt_get_result($stmt);



    }



	echo "<tbody>";

    $sql = "SELECT idProject, name, startDate, endDate, description, Person_idPerson FROM Project";
    $stmt = mysqli_prepare($link, $sql) or die("failed to prepare");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    while ($row = mysqli_fetch_array($result)) {

    	

        echo "<tr id='projectRow' value=".$row['idProject'].">";
        echo "<td><input id='name".$row['idProject']."' ondblclick='editField(\"name".$row['idProject']."\")' type='text' readonly value=\"" . $row['name'] . "\"</td>";
        echo "<td><input id='startDate".$row['idProject']."' ondblclick='editField(\"startDate".$row['idProject']."\")' type='date' readonly value=\"" . $row['startDate'] . "\"</td>";
        echo "<td><input id='endDate".$row['idProject']."' ondblclick='editField(\"endDate".$row['idProject']."\")' type='date' readonly value=\"" . $row['endDate'] . "\"</td>";
        echo "<td><textarea id='description".$row['idProject']."' ondblclick='editField(\"description".$row['idProject']."\")' readonly>" . $row['description'] . "</textarea></td>";

        $sql = "SELECT pawprint FROM Person WHERE idPerson = " . $row['Person_idPerson'];
        $leaderResult = mysqli_query($link, $sql);
        $leader = mysqli_fetch_assoc($leaderResult);
        echo "<td>".$leader['pawprint']. "</td>";


		$sql = "SELECT idPerson, pawprint FROM Person JOIN Person_has_Project ON Person_idPerson = idPerson WHERE Project_idProject = " . $row['idProject'];
	    $membersResult = mysqli_query($link, $sql);

        echo "<td>";
        while ($membersRow = mysqli_fetch_array($membersResult)) {
        	echo $membersRow['pawprint'];
        	echo "<br>";

        } 

        echo "<select readonly id='addMember".$row['idProject']."'>";
        echo "<option value=''></option>";


    	$sql = "SELECT idPerson, pawprint, email, userCreationPermission FROM Person WHERE idPerson NOT IN (SELECT Person_idPerson FROM Person_has_Project WHERE Project_idProject =".$row['idProject'].")";


    	$stmt = mysqli_prepare($link, $sql)or die("failed to bind param");
    	//mysqli_stmt_bind_param($stmt) or die("failed to bind param");
    	mysqli_stmt_execute($stmt)or die("failed to bind param");
    	$resultUsers = mysqli_stmt_get_result($stmt);

    while ($rowUser = mysqli_fetch_array($resultUsers)) {
        echo "<option value=\"";
        echo $rowUser['idPerson'];
        echo "\">";
        echo $rowUser['pawprint'];
        echo "</option>";
    }




        echo "</select>";

        echo "<input type='button' value='Add Member' onclick='addMember(".$row['idProject'].")'/> </td>";


        echo "<td><input type='button' value='edit project' onclick='editProject(".$row['idProject'].")'/> </td>";


        echo "</tr>";
    }
    echo "</tbody>";


    mysqli_close($link);



?>