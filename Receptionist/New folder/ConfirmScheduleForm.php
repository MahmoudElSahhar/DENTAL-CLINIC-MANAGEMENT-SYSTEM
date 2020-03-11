<!DOCTYPE html>
<html>
<head>
    <title>Confirm Schedule</title>
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
            include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
            include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
            session_start();

            
        ?>
    </div>

</body>
</html>