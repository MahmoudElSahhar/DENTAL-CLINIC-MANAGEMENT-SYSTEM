<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS\ComponentDesign.css">

</head>
<body>

    <?php require 'Classes\Doctor.php'; ?>
    <?php require 'Classes\Analysis.php'; ?>
    <?php require 'Classes\Excuse.php'; ?>
    <?php require 'Classes\Prescription.php'; ?>
    <?php require 'Classes\Bill.php'; ?>
    <?php require 'Classes\Appointment.php'; ?>
    <?php require 'Classes\Patient.php'; ?>
    <?php require 'Classes\Receptionist.php'; ?>
    <?php include 'Database\database.php'; ?>


    <form name="Login" action="" method="post">

        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Login Form</div>
        <div class="panel-body">

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="Username" placeholder="Username">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="Password" placeholder="Password">
        </div>      <br>

        <input id="submitButton" class="btn btn-primary" name="loginButton" type="submit" value="Login" /> <br><br>
        <div id="warning" class="alert alert-danger alert-dismissible ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Incorrect username or password... Please try again.
        </div>
        </div></div></div>

        <?php 
        
        if(isset($_POST['loginButton']))
        {    
            session_start();
            $_SESSION['date'] = date("Y-m-d");
            $username = $_POST['Username'];
            $password = $_POST['Password'];

            $userType = User::logIn($username,$password);

            if($userType == 1){
                header("Location: Doctor\DoctorForm.php");
            }
            else if($userType == 2){
                header("Location: Patient\PatientHomeForm.php");
            }
            else if($userType == 3){
                header("Location: Receptionist\ReceptionistForm.php");
            }
            else if($userType == 4){
                header("Location: Admin\AddReceptionistForm.php");
            }
            else
            {
                echo "<script>
                            
                            var x = document.getElementById(\"warning\");
                            x.style.display = \"block\";
                            
                        </script>";
            }
        }
        
        
        ?>
        

    </form>

</body>
</html>