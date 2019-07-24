<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['login_user'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: http://ec2-52-24-162-96.us-west-2.compute.amazonaws.com/");
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
            /* End of sticky footer -------------------------------------------------- */
            
            #informationContainer {
                text-align: center;
            }
            
            form {
                text-align: left;
            }
            
            h1 {
                text-align: center;
            }
            
            .infoBox {
                border: 2px solid black;
            }
            
            #block {
                display: inline-block;
                width: 30%;
            }
            
            .row {
                margin-bottom: 2%;
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
                <li><a href="updateInformation.php"><span class="glyphicon glyphicon-log-in"></span> Update Info</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
            </ul>
          </div>
        </nav>
        
        <div class="jumbotron">
            <h1>Procurement Management System</h1> 
        </div>

        <div id="informationContainer" class="container">
            <div class="row">
                <div class="col-sm-2"><p>test1</p></div>
                <div class="col-sm-4 infoBox"><p>test2</p></div>
                <div class="col-sm-4 infoBox"><p>test3</p></div>
                <div class="col-sm-2"><p>test4</p></div>
            </div>
        </div>
        
        <footer class="footer">
            <div class="container">
                <span class="text-muted footerSpan">Created by: Landen Eagan and Jared Zeman</span>
                <span class="text-muted footerSpan">Contact information: lceq58@mail.missouri.edu</span>
            </div>
        </footer>

    </body>
</html>