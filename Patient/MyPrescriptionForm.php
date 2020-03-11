<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>My Prescription</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet"  href="ComponentDesign.css">

    <style>
        
        .container {
            padding-left: 170px;
            width: 100%;
        }
        input[type="button"] {
            margin-left: 20%;
            width: 50%;
        }
        h4 {
            text-align: center;
            color: white;
        }
        /*******************************************/


        /*******************************************/

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


    <form name="myPrescriptionForm" action="" method="post" enctype="multipart/form-data">

        <br><br>

        <div class="container">

        <h1>My Prescriptions</h1>    <br>
        <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Content</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $prescriptions = $_SESSION['user']->Prescriptions;
        $appointments = $_SESSION['user']->Appointments;
                

        for($i=0;$i<sizeof($prescriptions);$i++)
        {
            $isFound = false;
            //$t = $appointments[$i]->Prescription;
            for($j=0;$j<sizeof($appointments);$j++)
            {
                $pre = $appointments[$j]->Prescription;
                if($pre != NULL){
                    if($prescriptions[$i]->ID == $pre->ID){
                        $isFound = true;
                    }
                }
            }
            if(!$isFound){
                echo "<tr>";
                        echo "
                        <td>
                            <a href='Prescription_Images/".$prescriptions[$i]->content."' target='new'>
                                <img src ='Prescription_Images/".$prescriptions[$i]->content."' width='350' height='350'/>
                            </a>
                        </td>
                        <td><input type='submit' name='".$prescriptions[$i]->ID."' value ='Cancel'></td>
                    </tr>";
            }
            $isFound = false;
        }
        echo "</tbody></table><br>";

        for($i=0;$i<sizeof($prescriptions);$i++)
        {
            if(isset($_POST[''.$prescriptions[$i]->ID]))
            {
                $_SESSION['user']->removePrescription($prescriptions[$i]->ID);
                $_SESSION['user']->Prescriptions = getPrescriptionsByPatientID($_SESSION['user']->ID);
                echo '<script>javascript:history.go(-1)</script>';
            }
        }

        ?>

        

        <!---------------------------------------------------------->
        <br><br>

        <!-- Trigger/Open The Modal -->
        <input type="button" id="myBtn" value="Add a new Prescription">

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <hr><br><br>
            <h1>Add a new prescription</h1>
            <h3>Upload an image</h3><br>
            <input type="file" id="prescriptionFile" name="prescriptionFile" accept="file_extension" >
            <!--<h4>OR</h4>
            <h3>Add text</h3>
            <textarea id='tArea' name='myPresContent' rows="4" cols="80" ></textarea>-->
            <br><input type='submit' id='addBtn' value ='Add' name='addMyPres'>
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
        
        $imgPath = "C:/xampp/htdocs/ClinicProject/Patient/Prescription_Images";


        if(isset($_POST['addMyPres']))
        {
            copy($_FILES["prescriptionFile"]["tmp_name"], $imgPath."/".$_FILES['prescriptionFile']['name']);
            $_SESSION['user']->uploadMyPrescription($_FILES['prescriptionFile']['name']);
            echo '<script>javascript:history.go(-1)</script>';
            //echo '<script>document.patientForm.tArea = ""</script>';
        }

        echo "</div>";

        ?>


    </form>


</body>
</html>