<!DOCTYPE html>
<html>
<head>
    <title>Add Prescription</title>
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

    <?php
        include 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
    ?>
    <div class='background'>
        <form action='' method='post' enctype='multipart/form-data'>
        <h3>Upload an image</h3><br>
        <input type="file" id="presFile" name="presFile" accept="file_extension" ><br><br><br>
        <input type='submit' name='addPrescription' value='Add'>
        

        </form>
    </div>  
    <?php
        if(isset($_POST['addPrescription'])){
            session_start();
            $_SESSION['user']->addPrescription($_SESSION['appointmentID']);
            $imgPath = "C:/xampp/htdocs/ClinicProject/Doctor/Prescriptions";
            copy($_FILES["presFile"]["tmp_name"], $imgPath."/".$_FILES['presFile']['name']);
            echo '<script>javascript:history.go(-2)</script>';
        }
    ?>

</body>
</html>