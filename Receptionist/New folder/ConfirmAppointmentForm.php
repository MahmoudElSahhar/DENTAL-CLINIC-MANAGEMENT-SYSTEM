<!DOCTYPE html>
<html>
<head>
    <title>Cofirm Appointments</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="MyCSS.css">
</head>
<body>
    <div class='sidenav'>
        <a href='AddAppointmentForm.php'>Add Appointments</a>
        <a href='ConfirmAppointmentForm.php'>Confirm Appointments</a>
        <a href='ConfirmScheduleForm.php'>Confirm Schedule</a>
        <a href='AddDoctorForm.php'>Add Doctors</a>
    </div>

    <div class='background'>
        <?php
            include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
            session_start();

            $apps = readAppointmentsToConfirm();

            echo "<form action='' method='post'>";
            echo "
                <table class='table table-light table-striped table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>AppointmentID</th>
                            <th>DoctorID</th>
                            <th>PatientID</th>
                            <th>Date</th>
                            <th>StartTime</th>
                            <th>EndTime</th>
                            <th>Type</th>
                            <th>Check</th>
                            <th>Action</th>
                        </tr>
                    </thead>
            ";
            for($i = 0 ; $i < count($apps) ; $i++){
                echo "
                    <tr>
                        <td>".$apps[$i]->ID."</td>
                        <td>".$apps[$i]->doctorID."</td>
                        <td>".$apps[$i]->patientID."</td>
                        <td>".$apps[$i]->date."</td>
                        <td>".$apps[$i]->startTime."</td>
                        <td>".$apps[$i]->endTime."</td>
                        <td>".$apps[$i]->type."</td>
                        <td><input type='submit' value='Check' name='e".$apps[$i]->ID."'></td>
                        <td id='action".$apps[$i]->ID."'></td>
                    </tr>
                ";
            }
            echo "</table>";
            echo "</form>";

            for($i = 0 ; $i < count($apps) ; $i++){
                if(isset($_POST['e'.$apps[$i]->ID])){
                    $ids = $_SESSION['user']->checkDoctorExcuses($apps[$i]->date , $apps[$i]->startTime , $apps[$i]->endTime);
                    if($ids != 0){
                        echo "<script>
                                    var element = document.createElement('input');
                                    element.setAttribute('type', 'submit');
                                    element.setAttribute('value', 'Cancel');
                                    element.style.backgroundColor = 'red';
                                    element.setAttribute('name', 'cancel".$apps[$i]->ID."');
                                    var d = document.getElementById('action".$apps[$i]->ID."');
                                    d.appendChild(element);
                                </script>";
                    }
                    else{
                        echo "<script>
                                    var element = document.createElement('input');
                                    element.setAttribute('type', 'submit');
                                    element.setAttribute('value', 'Confirm');
                                    element.style.backgroundColor = 'green';
                                    element.setAttribute('name', 'confirm".$apps[$i]->ID."');
                                    var d = document.getElementById('action".$apps[$i]->ID."');
                                    d.appendChild(element);
                                </script>";
                    }
                }
                else if(isset($_POST['confirm'.$apps[$i]->ID])){
                    echo ("confirm ".$apps[$i]->ID);
                    $_SESSION['user']->confirmAppointment($apps[$i]->ID);
                    header("Location: ConfirmAppointmentForm.php");
                    //echo '<script>javascript:history.go(-2)</script>';
                }
                else if(isset($_POST['cancel'.$apps[$i]->ID])){
                    echo ("cancel ".$apps[$i]->ID);
                    //send mail to patient to cancel appointment
                    $_SESSION['user']->deleteAppointment($apps[$i]->ID);
                    header("Location: ConfirmAppointmentForm.php");
                    //echo '<script>javascript:history.go(-2)</script>';
                }
            }
        ?>
    </div> 
</body>
</html>