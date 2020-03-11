<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Receptionist Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("https://yorksmilecare.com/wp-content/uploads/2012/10/york-pa-dental-background-2.jpg");
        }
        .btn {
            width: 70%;
            font-size: 15px;
            display: block;
            margin-left: 100px; 
        }
        .panel > .panel-heading {
            color: white;
        }
        .col-sm-6.col-sm-offset-3{
            padding-top: 6%;
        }
        .panel-body {
            background-color: Beige ;
        }
        .input-group.col-xs-7 {
            padding-left: 8%;
        }
        .panel-heading{
            text-align: center;
            font-size: 25px;
            background-color: #3e8e41;
        }
        #submitReceptionistButton:hover {
            border-color: blue;
            background-color: #ffffff;
            color: blue;
            font-weight: bold;
            
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>

    <?php require 'Prescription.php'; ?>
    <?php require 'Bill.php'; ?>
    <?php require 'Appointment.php'; ?>
    <?php require 'Receptionist.php'; ?>
    <?php include 'databaseReader.php'; ?>


    <form name="RecepionistLogin" action="" method="post">

        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Login Form</div>
        <div class="panel-body">

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="receptionistUsername" placeholder="Username">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="receptionistPassword" placeholder="Password">
        </div>      <br>

        <!--Username: <input name="patientUsername" type="text" />    <br /><br />
        Password: <input name="patientPassword" type="password" />    <br /><br />

        <input id="submitPatientButton" name="submitButton" type="submit" value="Submit" /> -->

        <input id="submitReceptionistButton" class="btn btn-primary" name="loginButton" type="submit" value="Login" /> <br><br>
        <div id="warning" class="alert alert-danger alert-dismissible ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Incorrect username or password... Please try again.
        </div>
        </div></div></div>

        <?php 
        
        if(isset($_POST['loginButton']))
        {    
            $receptionist = new Receptionist;
            
            $receptionist->username = $_POST['receptionistUsername'];
            $receptionist->password = $_POST['receptionistPassword'];
            
            $var = databaseReceptionistLogin($receptionist->username, $receptionist->password);

            if($var == false)
            {
                echo "<script>
                        
                        var x = document.getElementById(\"warning\");
                        x.style.display = \"block\";
                        
                    </script>";
            }
            else
            {
                session_start();
                $_SESSION['user'] = $var;
                //echo"<script>console.log('".var_dump($_SESSION['user'])."')</script>";
                header("Location:HomePage.php");
            }
        }
        
        
        ?>
        

    </form>

</body>
</html>