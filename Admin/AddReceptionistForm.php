<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Add Receptionist</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link  type="text/css" rel="stylesheet" href="ComponentDesign.css">
    <style>
        input[type="button"] {
            margin-left: 20%;
            width: 50%;
        }
        h4 {
            text-align: center;
            color: white;
        }
        #addBtn {
            margin-left: 330px;
        }
        .input-group.col-xs-7{
            width: 60%;
            margin-left: 15%;
        }
    </style>
</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\User.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Admin.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    
    <div class="sidenav">
        <a href="PatientProfileForm.php" style="padding-top:20px;">My Account</a>
        <a href="MyAppointmentsForm.php">Appointments</a>
        <a href="AnalysisForm.php">Analysis</a>
        <a href="PrescriptionForm.php">Prescription</a>
        <a href="InquiryForm.php">Inquiries</a>
        <a href="#contact">About us</a>
        </div>

    <form name="adminForm" action="" method="post" enctype="multipart/form-data">

        <br><br>

    <div class="container">
    
    <h1>Add Receptionist</h1>    <br>
    <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>User Type</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>


        <?php
        session_start();
        $users = getAllUsers();
        $userTypes = array("Doctor","Patient","Receptionist","Admin");
        
        for($i=0;$i<sizeof($users);$i++)
        {
            echo "<tr>
                    <td>".$users[$i]->fullName."</td>
                    <td>".$users[$i]->username."</td>
                    <td>".$users[$i]->password."</td>
                    <td>".$userTypes[($users[$i]->userType)-1]."</td>
                    <td><input type='submit' name='".$users[$i]->ID."' value ='Cancel'></td>
                    
                </tr>";
        }
        echo "</tbody></table><br>";
        
        for($i=0;$i<sizeof($users);$i++)
        {
            if(isset($_POST[''.$users[$i]->ID]))
            {
                $_SESSION['user']->removeUser($users[$i]);
                echo '<script>javascript:history.go(-1)</script>';
            }
        }
        
        ?>

        <!---------------------------------------------------------->
        <br><br>

        <!-- Trigger/Open The Modal -->
        <input type="button" id="myBtn" value="Add a new Receptionist">

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Add a Receptionist</h1>

            <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="receptionistName" placeholder="FullName">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type="date" name="receptionistAge" class="form-control" max="2000-12-31" min="1950-01-01">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="text" class="form-control" name="receptionistTelephone" placeholder="Telephone">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="receptionistUsername" placeholder="Username">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="receptionistPassword" placeholder="Password">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="text" class="form-control" name="receptionistEmail" placeholder="Email">
        </div>      <br>

            <br><input type='submit' id='addBtn' value ='Add' name='addReceptionist'>
        </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
        <!---------------------------------------------------------->


        <?php 
        $imgPath = "C:/xampp/htdocs/ClinicProject/Patient/Analysis_Images";
        
        if(isset($_POST['addReceptionist']))
        {
            $recep = new Receptionist;
            $recep->fullName = $_POST['receptionistName'];
            $recep->dob = $_POST['receptionistAge'];
            $recep->email = $_POST['receptionistEmail'];
            $recep->telephone = $_POST['receptionistTelephone'];
            $recep->username = $_POST['receptionistUsername'];
            $recep->password = $_POST['receptionistPassword'];
            $_SESSION['user']->addReceptionist($recep);
            echo '<script>javascript:history.go(-1)</script>';
        }

        echo "</div>";
        
        ?>
        

    </form>

</body>
</html>