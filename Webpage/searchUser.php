<?php    
session_start();
include("common.php");



    $link = db_connect();


	$pawprint = mysqli_real_escape_string($link, $_REQUEST["pawprintSearch"]) . "%";
	$email = mysqli_real_escape_string($link, $_REQUEST["emailSearch"]) . "%";


    $sql = "SELECT idPerson, pawprint, email, userCreationPermission FROM Person WHERE pawprint LIKE ? AND email LIKE ?";
    $stmt = mysqli_prepare($link, $sql) or die($link->error);
    mysqli_stmt_bind_param($stmt, "ss", $pawprint, $email) or die("failed to bind param");


    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);



    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['pawprint'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";    
        echo "<td>";
        if ($row['userCreationPermission'] == 1) {
 			echo "<input type='radio' name='userCreationPermission" . $row['idPerson'] . "'value=1 checked> yes<br>";
  			echo "<input type='radio' name='userCreationPermission" . $row['idPerson'] . "'value=0> no<br>";      	
        }
        else {
 			echo "<input type='radio' name='userCreationPermission" . $row['idPerson'] . "' value=1> yes<br>";
  			echo "<input type='radio' name='userCreationPermission" . $row['idPerson'] . "' value=0 checked> no<br>";      	
        }
        echo "</td>";

        echo "<td> <input type='button' value='update' onclick='update(\"" . $row['idPerson'] . "\")'/> </td>";
        echo "</tr>";
    }


    mysqli_close($link);

?>