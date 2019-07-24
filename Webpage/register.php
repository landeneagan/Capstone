<?php
session_start();                //uses for login
include("common.php");
$link = db_connect();
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
            function permissionsDisplay(value){
            var i;
                if(value == "Custom"){
                        //document.getElementById("permissionsDiv").style.display = 'block';
                        var x = document.getElementsByClassName("permissionsClass");
                        for (i = 0; i < x.length; i++) { 
                            x[i].style.display = 'block';
                        }
                }
                else{
                        var x = document.getElementsByClassName("permissionsClass");
                        for (i = 0; i < x.length; i++) { 
                            x[i].style.display = 'none';
                        }
                }
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
            </ul>
          </div>
        </nav>
        
        <div class="jumbotron">
            <h1>Procurement Management System</h1> 
        </div>

        <div id="RegisterContainer" class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <form class="form-regester" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Student email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="pawprint" class="sr-only">Pawprint</label>
                            <input type="text" id="pawprint" class="form-control" name="pawprint" placeholder="pawprint" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <select name="permissions" onchange="permissionsDisplay(this.value)">
                                <option value="Student">Student</option>
                                <option value="TA">TA</option>
                                <option value="Custom">Custom</option>
                            </select>
                        </div>
                        <div class="form-group permissionsClass" id="permissionsDiv" style="display: none;">
                            <p>User Creation Permission</p>
                            <input type="radio" name="userCreationPermission" value="1">yes<br>
                            <input type="radio" name="userCreationPermission" value="0" checked>no
                            <p>Project Creation Permission</p>
                            <input type="radio" name="projectCreationPermission" value="1">yes<br>
                            <input type="radio" name="projectCreationPermission" value="0" checked>no
                            <p>Order Aproval Permission</p>
                            <input type="radio" name="orderApprovalPermission" value="1">yes<br>
                            <input type="radio" name="orderApprovalPermission" value="0" checked>no
                        </div>
                        <input class="btn btn-lg btn-primary btn-block" type="submit" name="register" value="Register"></button>
                    </form>
                </div>
                <div class="col-sm-4"></div>
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




        if(isset($_POST['register'])){ //register new user function
            $pawprint = mysqli_real_escape_string($link,$_POST['pawprint']);
            $email = mysqli_real_escape_string($link,$_POST['email']);
            $UserCreationPermission = mysqli_real_escape_string($link,$_POST['userCreationPermission']);
            $ProjectCreationPermission = mysqli_real_escape_string($link,$_POST['projectCreationPermission']);
            $OrderApprovalPermission = mysqli_real_escape_string($link,$_POST['orderApprovalPermission']);
            $mypassword = password_hash(mysqli_real_escape_string($link,$_POST['password']), PASSWORD_DEFAULT);            //hash password
            $sql = "SELECT idPerson FROM Person WHERE pawprint = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $pawprint) or die("failed to bind param on line 57");
            mysqli_stmt_execute($stmt) or die("failed to execulte stmt on line 58");
            $result = mysqli_stmt_get_result($stmt);
            
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if($count != 0){            //cheacks if another user has the same username

                echo "username is taken please use another";
        
            }
            else{                                                   //otherwise continue

$link = db_connect();

mysqli_report(MYSQLI_REPORT_ALL);

                $sql = "INSERT INTO Person (pawprint, email, password, userCreationPermission, projectCreationPermission, orderApprovalPermission) VALUES (?, ?, ?, ?, ?, ?)";
                echo $sql;
                $stmt = mysqli_prepare($link, $sql) or die($link->error);
                mysqli_stmt_bind_param($stmt, "sssiii", $pawprint, $email, $mypassword, $UserCreationPermission, $ProjectCreationPermission, $OrderApprovalPermission) or die();
                mysqli_stmt_execute($stmt) or die("failed to execute");
                $result = mysqli_stmt_get_result($stmt);
                
                echo "succesfully registered, you may login now";
        }
    }
?>

