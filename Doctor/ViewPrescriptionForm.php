<!DOCTYPE html>
<html>
<head>
    <title>Add Prescription</title>
    <title>View My Schedule</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="MyCSS.css">

    <style>
        input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
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
            border: 1px solid Teal;
        }
        .table{
            width: 90%;
            height: 90%;
        }
    </style>
</head>
<body>
    <?php include 'sideNav.php'; ?>

    <div class='background'>
    <?php
        include 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php';
        ob_start();
        session_start();

        //$appointments = $_SESSION['user']->Appointments;
        $appointments = readAllAppointmentsByDoctorID($_SESSION['user']->ID);

        echo "<h1>Manage Prescriptions</h1>";
        echo "<form action='' method='post'>";
        echo "
            <div class='container'>
                <table class='table table-light table-striped table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Prescription</th>
                            <th>Add/Delete Prescription</th>
                        </tr>
                    </thead>
            ";
            for($i = 0 ; $i < count($appointments) ; $i++){
                echo "
                    <tr>
                        <td>".getUserNameByUserID($appointments[$i]->patientID)."</td>
                        <td>".$appointments[$i]->date."</td>
                        <td>".$appointments[$i]->type."</td>
                        <td>".$appointments[$i]->startTime."</td>
                        <td>".$appointments[$i]->endTime."</td>";
                        if($appointments[$i]->Prescription == NULL){
                            echo "<td></td>";
                            echo "<td><input type='submit' value='Add' name='addPres".$appointments[$i]->ID."'></td>";
                        }
                        else{
                            echo "<td><a href='Prescriptions/".$appointments[$i]->Prescription->content."' target='new'>
                                        <img src ='Prescriptions/".$appointments[$i]->Prescription->content."' width='350' height='350'/>
                                    </a></td>";
                            echo "<td><input type='button' value='Delete' id='deletePres".$appointments[$i]->ID."'></td>";
                        }
                        
                    echo "</tr>
                ";
            }
            echo "</table>";
            echo "</form>";

            for($i = 0 ; $i < count($appointments) ; $i++){
                if(isset($_POST['addPres'.$appointments[$i]->ID])){
                    $_SESSION['appointmentID'] = $appointments[$i]->ID;
                    header("Location: AddPrescriptionForm.php");
                }
                /*else if(isset($_POST['editPres'.$appointments[$i]->ID])){
                    $_SESSION['appointmentID'] = $appointments[$i]->ID;
                    header("Location: UpdatePrescriptionForm.php");
                }*/
                else if(isset($_POST['deletePres'.$appointments[$i]->ID])){
                    $_SESSION['user']->deletePrescription($appointments[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
    ?>
    </div>
</body>
</html>