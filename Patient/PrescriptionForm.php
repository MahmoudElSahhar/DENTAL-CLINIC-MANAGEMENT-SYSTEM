<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Add Prescription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">

    <style>
    
        .w3-btn.w3-teal {
            font-size: 30px;
            color: #f2f2f2;
            background-color: Teal;
        }
        .w3-btn.w3-teal:hover {
            background-color: #f2f2f2;
            color: Teal;
        }
        .w3-bar {
            align-content: center;
        }

    </style>
</head>
<body>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    
    <?php include 'sideNav.php'; ?>


    <form name="prescriptionForm" action="" method="post">

        <br><br>

        <div class="container">

            <h1>Prescriptions</h1>    <br>

            <h2>View your prescriptions</h2>
            <br>
            <button type="button" class="w3-btn w3-teal" onclick="window.location.href='MyPrescriptionForm.php'">My Prescriptions</button>

            <br><hr><br>

            <h2>View prescriptions of your appointments</h2>
            <br>
            <button type="button" class="w3-btn w3-teal" onclick="window.location.href='AppointmentPrescriptionsForm.php'">Appointments Prescriptions</button>
            
        
        </div>

    </form>

        <!---------------------------------------------------------------->

    

</body>
</html>