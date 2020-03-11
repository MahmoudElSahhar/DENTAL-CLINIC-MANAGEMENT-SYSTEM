<!DOCTYPE html>
<html>
<head>
    <title>Doctor</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="MyCSS.css">
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
            //ob_start();
            session_start();
    
            $appointments = $_SESSION['user']->Appointments;

            echo "<h1>Today's Appointments</h1>";

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
                            </tr>
                        </thead>
                ";
                for($i = 0 ; $i < count($appointments) ; $i++){
                    if($appointments[$i]->date == date("Y-m-d")){
                        echo "
                            <tr>
                                <td>".getUserNameByUserID($appointments[$i]->patientID)."</td>
                                <td>".$appointments[$i]->date."</td>
                                <td>".$appointments[$i]->type."</td>
                                <td>".$appointments[$i]->startTime."</td>
                                <td>".$appointments[$i]->endTime."</td>
                            </tr>
                        ";
                    }
                }
                echo "</table>";
                echo "</form>";
        ?>
    </div>
</body>
</html>