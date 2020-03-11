<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title> Doctors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("https://yorksmilecare.com/wp-content/uploads/2012/10/york-pa-dental-background-2.jpg");
        }
        * {box-sizing: border-box}
        h3 {
            font-size: 30px;
        }
        .sidenav {
            height: 100%;
            width: 190px;
            position: fixed;
            background-color: #111;
            padding-top: 30px;
        }
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }
        .sidenav a:hover {
            color: #f1f1f1;
        }
        /***********************************/
        .container {
            padding-left: 170px;
            width: 100%;
        }
        .table {
            font-size: 20px;
        }
        #confirm {
            width: 30%;
            margin-bottom: 20px;
            margin-left: 450px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: DarkGreen;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
            
        }
        #confirm:hover {
            background-color: #f2f2f2;
            color: DarkGreen;
            font-style: bold;
            font-size: 20px;
            border: 2px solid DarkGreen;
        }
        h3{
            color: white;
            font-size:30px;
        }
        .header {
            text-align: center;
            font-size: 40px;
            background-color: #111;
            color: white;
            padding-bottom: 7px;
        }
        input[type="button"] {
            width: 70%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: Teal;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
            
        }
        input[type="button"]:hover {
            background-color: #f2f2f2;
            color: Teal;
            font-style: bold;
            font-size: 20px;
            border: 2px solid Teal;
        }
        #cancel {
            background-color: darkred;
            color: white;
        }
        table {
            text-align: center;
            margin-left: 70px;
        }
        hr
        {
            margin-left: 150px;
        }
        
    </style>
</head>
<body>

    <?php require 'Prescription.php'; ?>
    <?php require 'Bill.php'; ?>
    <?php require 'Appointment.php'; ?>
    <?php require 'Doctor.php'; ?>
    <?php require 'Patient.php'; ?>
    <?php include 'databaseReader.php'; ?>
    <?php include 'databaseWriter.php'; ?>
    
     <div class='sidenav'>
        <a href='ReceptionistProfile.php' style='padding-top:20px;'>My Account</a>
        <a href='Receptionistdisplay.php'> Appointments</a>
        <a href='ManageDoctor.php'> Doctors</a>
        <a href='ReadAllTheAppointments.php'>Bills</a>
        <a href='Inquirydisplay.php'>Inquiries</a>
       </div> 


    <form name="DoctorProfile" action="" method="post">

        <h1>Doctor Profile</h1>

  <div class="container">
    
    <hr>
    <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Doctor</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Confirmed</th>
            <th>Edit</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>
        
        


    <?php
        session_start();
        $doctor = $_SESSION['user']->viewDoctor();
        
                   echo" <td><input id='edit' type='button' value='Edit' onclick='alert(".update($appointments[$i]->ID).")'</td>
                    <td><input id='cancel' type='button' value='Cancel' onclick='alert(".cancel().")'</td>
                </tr>";
        
        echo "</tbody></table>";
        echo "<br><input type='submit' id='addBtn' value ='Add' name='addAppointment'>";
        echo "</div>";
        function update($id){
            $_SESSION['patient']->updateAppointment($id);
        }
        function add($id){
            
        }
        function cancel(){
            $_SESSION['patient']->cancelAppointment();
        }
        /*if(isset($_POST['submitUpdate']))
        {    
            
            $id = $_POST['updateAppoints'][0];
            $_SESSION['patient']->updateAppointment($id);
        }
        else if(isset($_POST['addAppointment']))
        {

        }
        else if(isset($_POST['submitCancel']))
        {
            $_SESSION['patient']->cancelAppointment();
        }*/
        
    ?>

    </form>

</body>
</html>