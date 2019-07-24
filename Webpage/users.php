<?php
session_start();                //uses for login
include("common.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Procurement Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript">
            function search(){
                var pawprint = document.getElementById("pawprintSearch").value;
                var email = document.getElementById("emailSearch").value;


                var data = new FormData();
                data.append('pawprintSearch', document.getElementById("pawprintSearch").value);
                data.append('emailSearch', document.getElementById("emailSearch").value);


                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("users").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("POST", "searchUser.php", true);
                xmlhttp.send(data);

            }


            function update(idPerson){
                document.getElementById("users").innerHTML = "called inside update idPerson = " + idPerson;
            }

        </script>
        
        <style>
            
            .jumbotron{
                text-align: center;
            }
            
            /* Sticky footer styles -------------------------------------------------- */
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-bottom: 60px; /* Margin bottom by footer height */
            }
            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 60px; /* Set the fixed height of the footer here */
                line-height: 60px; /* Vertically center the text there */
                background-color: #f5f5f5;
                
                text-align: center;
            }
            .footerSpan {
                margin: 5%;
            }

            #loginContainer {
                text-align: center;
            }
            
            input {
                margin: 5px;
            }
            
        </style>
    </head>
    <body>
        
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="requisitionForm.php">Requisition Form</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
            </ul>
          </div>
        </nav>
        
        <div class="jumbotron">
            <h1>Procurement Management System</h1> 
        </div>

        <div id="tableContainer" class="container">
            <div class="row" id="">
            <form method="post" name="userForm">
                <table  class="table">
                    <th>Pawprint</th>
                    <th>Email</th>
                    <th>User Creation Permission</th>
                    <th>Action</th>
                    <tr>
                    <td><input type='text' onkeyup="search()" id="pawprintSearch" name='pawprintSearch'></td>
                    <td><input type='text' onkeyup="search()" id="emailSearch" name='emailSearch'></td>
                    </tr>
                    <tbody id="users">
                        <?php
                        printUsers();
                        ?>
                    </tbody>
                </table>
            </form>
            </div>
        </div>  
        <footer class="footer">
            <div class="container">
                <span class="text-muted footerSpan">Created by: Landen Eagan and Jared Zeman</span>
                <span class="text-muted footerSpan">Contact information: <a href="lceq58@mail.missouri.edu">lceq58@mail.missouri.edu</a></span>
            </div>
        </footer>
    </body>
</html>

<?php

function printUsers(){


    $link = db_connect();


    $sql = "SELECT pawprint, email, idPerson, userCreationPermission FROM Person";


    $stmt = mysqli_prepare($link, $sql);
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


}

?>
