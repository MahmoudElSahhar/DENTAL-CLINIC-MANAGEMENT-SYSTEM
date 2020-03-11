<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Patient SignUp</title>
    <script type="text/javascript" src="validation.js"></script>
        <link rel="stylesheet" href="ComponentDesign.css">

    <style>
        input[type="submit"] {
            background-color: green;
            border-color: green;
        }

        .panel > .panel-heading {
            background-color: green;
        }
        .panel {
            border-color: green;
        }
        #submitPatientButton:hover {
            border-color: green;
            background-color: #ffffff;
            color: green;
            font-weight: bold;
        }
        .valDiv {
            padding-left: 20%;
            color: red;
        }
    </style>
</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\User.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    

    <form name="patientForm" action="" method="post">

        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Registration Form</div>
        <div class="panel-body">

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="FullName" onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="fullnameDiv"></div>     <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type="date"  id="dob" name="dob" class="form-control" max="2010-12-31" min="1950-01-01" onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="dobDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="telephoneDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="username" name="username" pattern='[A-Za-z\\s]*' placeholder="Username" onblur="checkAvailability()" required>
        </div> <div class="valDiv" id="usernameDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="passwordDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="emailDiv"></div>      <br>

        <input id="submitPatientButton" class="btn btn-primary" name="submitButton" type="submit" value="SignUp" /> <br><br>
        
        </div></div></div>

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

        <?php 
        
        if(isset($_POST['submitButton']))
        {    
            startConnection();
            Patient::signUp();
            header("Location: http://localhost/ClinicProject/LogInForm.php");
        }
        
        
        ?>
        

    </form>

</body>
</html>