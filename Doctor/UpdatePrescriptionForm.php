<!DOCTYPE html>
<html>
<head>
    <title>Update Prescription</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="ComponentDesign.css">
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
        session_start();

        $pres = getPrescriptionByAppointmentID($_SESSION['appointmentID']);

        echo "
            <form action='' method='post'>
            Content : <input id='contentID' type='text' name='content'><br><br><br>
            <input type='submit' name='updatePrescription' value='Update'>

            <script>
                document.getElementById('contentID').value = '".$pres->content."';
            </script>
            </form>
        ";

        if(isset($_POST['updatePrescription'])){
            $pres->content = $_POST['content'];
            $_SESSION['user']->updatePrescription($pres);
            echo '<script>javascript:history.go(-2)</script>';
        }
    ?>
    </div>

    
</body>
</html>