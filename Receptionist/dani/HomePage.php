<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Receptionist Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">
    
</head>
<body>

    <?php require 'Prescription.php'; ?>
    <?php require 'Bill.php'; ?>
    <?php require 'Receptionist.php'; ?>
    <?php require 'Appointment.php'; ?>
    <?php require 'Doctor.php'; ?>
    <?php require 'Patient.php'; ?>
    <?php include 'databaseReader.php'; ?>
    <?php include 'databaseWriter.php'; ?>
    
    <div class="sidenav">
        <a href="ReceptionistProfile.php" style="padding-top:20px;">My Account</a>
        <a href="Receptionistdisplay.php"> Appointments</a>
        <a href="Doctordisplay.php"> Doctors</a>
        <a href="ReadAllTheAppointments.php">Bills</a>
        <a href="Inquirydisplay.php">Inquiries</a>
        </div>