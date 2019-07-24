<?php
    include("config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        
        $sql = "SELECT password FROM Person WHERE pawprint = '$myusername'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if(password_verify($mypassword, $row['password'])) {
            $_SESSION['login_user'] = $myusername;
            header("location: home.php");
        }else {
            $error = "Your Login Name or Password is invalid";
            echo 'Incorrect Username or Password.';
        }
    }
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
              <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            </ul>
          </div>
        </nav>
        
        <div class="jumbotron">        
            <h1>Procurement Management System</h1> 
        </div>

        <div id="loginContainer" class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <form class="form-signin" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                        <div class="form-group">
                            <label for="inputPawprint" class="sr-only">Pawprint</label>
                            <input type="text" name="username" id="inputPawprint" class="form-control" placeholder="Pawprint" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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