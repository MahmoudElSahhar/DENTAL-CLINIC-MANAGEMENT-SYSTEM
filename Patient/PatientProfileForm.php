<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">
    <script type="text/javascript" src="validation.js"></script>

    <style>
        .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -16px;
        }
        .col-50 {
        flex: 50%;
        }
        .col-50 {
        padding: 0 16px;
        width: 70%;
        }
        .container {
        width: 100%;
        padding: 5px 20px 15px 20px;
        padding-left: 230px;
        border: 1px solid lightgrey;
        border-radius: 3px;
        }
        input[type="submit"] {
            background-color: Teal;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
        }
        input[type="submit"]:hover {
            background-color: #f2f2f2;
            color: Teal;
            font-style: bold;
            font-size: 20px;
            border: 2px solid Teal;
        }

        input {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        label {
        margin-bottom: 10px;
        display: block;
        }
        .valDiv {
            padding-left: 5%;
            color: red;
        }
    </style>
</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\User.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    
    <?php include 'sideNav.php'; ?>

    <form name="PatientProfileForm" action="" method="post">

        <div class="container">
        <div class="col-50">
        <h3>Your Profile</h3>

        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="John M. Doe" onblur="blurFunction(this.name)" required>
        <div class="valDiv" id="fullnameDiv"></div>     <br>

        <label for="email"><i class="fa fa-envelope"></i> Email</label>
        <input type="text" id="email" name="email" placeholder="john@example.com" onblur="blurFunction(this.name)" required>
        <div class="valDiv" id="emailDiv"></div>      <br>

        <label for="adr"><i class="fa fa-phone"></i> Telephone</label>
        <input type="text" id="telephone" name="telephone" placeholder="010XXXXXXXX" onblur="blurFunction(this.name)" required>
        <div class="valDiv" id="telephoneDiv"></div>      <br>

        <label for="city"><i class="fa fa-user"></i> Username</label>
        <input type="text" id="username" name="username" placeholder="john123" onblur="checkAvailability()" required>
        <div class="valDiv" id="usernameDiv"></div>      <br>

        <script>
        
            var s = '<?php session_start(); echo $_SESSION['user']->fullName; ?>';
            document.getElementById('fullname').value = s;
            document.getElementById('email').value = '<?php echo $_SESSION['user']->email; ?>';
            document.getElementById('telephone').value = '<?php echo $_SESSION['user']->telephone; ?>';
            document.getElementById('username').value = '<?php echo $_SESSION['user']->username; ?>';
            
        </script>

        <div class="row">
           <div class="col-50">
                <label for="state"><i class="fa fa-calendar"></i> Date Of Birth</label>
                <input type="date" id="DOB" name="DOB" max="2000-12-31" min="1950-01-01" onblur="blurFunction(this.name)" required>
                <div class="valDiv" id="dobDiv"></div>      <br>
            </div>
            <div class="col-50">
                <label for="zip"><i class="fa fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" onblur="blurFunction(this.name)" required>
                <div class="valDiv" id="passwordDiv"></div>      <br>
            </div>
        </div>
        <script>
            document.getElementById('password').value = '<?php echo $_SESSION['user']->password; ?>';
            document.getElementById('DOB').value = '<?php echo $_SESSION['user']->dob; ?>';
        </script>
        </div>

        <script>
            function checkAvailability() {

                jQuery.ajax({
                url: "CheckUser.php",
                data:'username='+$("#username").val(),
                type: "POST",
                success:function(data){
                $("#usernameDiv").html(data);
                },
                error:function (){}
                });
            }
        </script>

        <input type='submit' name='editAccount' value='Edit Account'>   <br>
        <input type='submit' name='deleteAccount' value='Delete Account'>   <br>
        <?php
        
        if(isset($_POST['editAccount']))
        {
            $_SESSION['user']->fullName = $_POST['fullname'];
            $_SESSION['user']->email = $_POST['email'];
            $_SESSION['user']->telephone = $_POST['telephone'];
            $_SESSION['user']->username = $_POST['username'];
            $_SESSION['user']->password = $_POST['password'];
            $_SESSION['user']->dob = $_POST['DOB'];
            $_SESSION['user']->editAccount();
            echo '<script>javascript:history.go(-2)</script>';
            
        }
        else if(isset($_POST['deleteAccount']))
        {
            $_SESSION['user']->deleteAccount($_SESSION['user']->ID);
            echo '<script>javascript:history.go(-2)</script>';
        }

         ?>
         

    </form>

</body>
</html>