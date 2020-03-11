<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Appointment Prescription</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">
    <style>
        
        .container {
            padding-left: 170px;
            width: 100%;
        }

    </style>
</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    <?php session_start(); ?>
    
    
    <?php include 'sideNav.php'; ?>


    <form name="prescriptionForm" action="" method="post"  enctype="multipart/form-data">

        <br><br>

        <div class="container">

        <h1>Prescriptions</h1>    <br>
        <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Content</th>
            <!--<th>Cancel</th>-->
        </tr>
        </thead>
        <tbody>


        <?php
        //session_start();
        $appointments = $_SESSION['user']->Appointments;
        

        for($i=0;$i<sizeof($appointments);$i++)
        {
            //echo "<script>alert(".sizeof($appointments[$i]->Prescription).")</script>";
            $doctor = getDoctor($appointments[$i]->doctorID , date('Y-m-d'));
            //$pre = $appointments[$i]->Prescription;
            $prescription = $appointments[$i]->Prescription;//getPrescription($pre->prescriptionID);
            echo "<tr>
                    <td>".$doctor->fullName."</td>
                    <td>".$appointments[$i]->date."</td>
                    <td>".$appointments[$i]->startTime."</td>";
                    if($prescription == NULL)
                    echo "<td>No Prescription</td>";
                    else
                    echo "
                    <td>
                        <a href='Prescription_Images/".$prescription->content."' target='new'>
                            <img src ='Prescription_Images/".$prescription->content."' width='350' height='350'/>
                        </a>
                    </td>";
                    //echo "<td><input type='submit' name='".$appointments[$i]->ID."' value ='Cancel'></td>";
                    
            echo "</tr>";
        }
        echo "</tbody></table><br>";

        /*for($i=0;$i<sizeof($appointments);$i++)
        {
            if(isset($_POST[''.$appointments[$i]->ID]))
            {
                $pre = $appointments[$i]->Prescription;
                //echo ("<script>alert(".$pre->prescriptionID.")</script>");
                $_SESSION['user']->removePrescription($pre->prescriptionID);
                
                echo '<script>javascript:history.go(-1)</script>';
            }
        }*/

        ?>

        <!--<hr><br><br>
        <h3>Add a prescription</h3>
        <textarea id='tArea' name='presContent' rows="4" cols="80" ></textarea>
        <br><input type='submit' id='addBtn' value ='Add' name='addPres'>   -->

        <?php 

        /*if(isset($_POST['addPres']))
        {
            $_SESSION['user']->uploadPrescription($_POST['presContent']);
            echo '<script>javascript:history.go(-1)</script>';
            echo '<script>document.patientForm.tArea = ""</script>';
        }*/

        echo "</div>";

        ?>


    </form>


</body>
</html>