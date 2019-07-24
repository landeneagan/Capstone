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
            function createProjects(){

                console.log("in createProjects");

                var xmlhttp = new XMLHttpRequest();
                var data = new FormData();
                data.append('projectName', document.getElementById("projectName").value)
                data.append('leader', document.getElementById("TeamLead").value)
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("recentProjects").innerHTML = this.responseText;
                }
                }
                xmlhttp.open("POST", "addProject.php", true);
                xmlhttp.send(data);
            }

            function collapsible(ele){
                var content = ele.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }

            }

            function addMember(projectID){
                var xmlhttp = new XMLHttpRequest();
                var data = new FormData();
                data.append('projectID', projectID);
                data.append('personID', document.getElementById("addMember" + projectID).value);
                xmlhttp.open("POST", "addUserToProject.php", true);
                xmlhttp.send(data);
            }

            function removeMember(projectID){
            }

            function editField(ele){

                console.log("in edit field");


                document.getElementById(ele).readOnly = false;
            }

            function editProject(projectID){
                var xmlhttp = new XMLHttpRequest();
                var data = new FormData();
                data.append('projectID', projectID);
                data.append('name', document.getElementById("name" + projectID).value);
                data.append('startDate', document.getElementById("startDate" + projectID).value);
                data.append('endDate', document.getElementById("endDate" + projectID).value);
                data.append('description', document.getElementById("description" + projectID).value);
                xmlhttp.open("POST", "updateProject.php", true);
                xmlhttp.send(data); 
                console.log(document.getElementById("description" + projectID).value);

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
    <body onload="createProjects()">
        
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

        <div id="RegisterContainer" class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <form class="form-regester">
                        <h1 class="h3 mb-3 font-weight-normal">Register Project</h1>
                        <div class="form-group">
                            <input type="text" name="projectName" class="form-control" id="projectName"  placeholder="Project Name" required>
                        </div>
                        <div class="form-group">
                            <select id="TeamLead" class="TeamLead form-control" name="TeamLead" required autofocus>
                            <option value=""></option>
                                <?php
                                printUsers();
                                ?>
                            </select>
                        </div>
                        <input class="btn btn-lg btn-primary btn-block" type="button" value="Submit" onclick="createProjects()"></button>
                    </form>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="form-regester">

                        <table id="recentProjects" class="table">
                        </table>
                    </div>
                </div>
                <div class="col-sm-2"></div>
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


    $sql = "SELECT idPerson, pawprint, email, userCreationPermission FROM Person";


    $stmt = mysqli_prepare($link, $sql)or die("failed to bind param");
    mysqli_stmt_execute($stmt)or die("failed to bind param");
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_array($result)) {
        echo "<option value=\"";
        echo $row['idPerson'];
        echo "\">";
        echo $row['pawprint'];
        echo "</option>";
    }


    mysqli_close($link);

}

?>