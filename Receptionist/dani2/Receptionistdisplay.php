<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title> Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("https://yorksmilecare.com/wp-content/uploads/2012/10/york-pa-dental-background-2.jpg");
        }
        * {box-sizing: border-box}
        h3 {
            font-size: 30px;
        }
        .sidenav {
            height: 100%;
            width: 15%;
            position: fixed;
            background-color: #111;
            padding-top: 30px;
        }
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }
        .sidenav a:hover {
            color: #f1f1f1;
        }
        /***********************************/
        .container {
            padding-left: 170px;
            width: 100%;
        }
        .table {
            font-size: 20px;
        }
        #confirm {
            width: 30%;
            margin-bottom: 20px;
            margin-left: 450px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: DarkGreen;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
            
        }
        #confirm:hover {
            background-color: #f2f2f2;
            color: DarkGreen;
            font-style: bold;
            font-size: 20px;
            border: 2px solid DarkGreen;
        }
        h3{
            color: white;
            font-size:30px;
        }
        .header {
            text-align: center;
            font-size: 40px;
            background-color: #111;
            color: white;
            padding-bottom: 7px;
        }
        input[type="button"] {
            width: 70%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: Teal;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
            
        }
        input[type="button"]:hover {
            background-color: #f2f2f2;
            color: Teal;
            font-style: bold;
            font-size: 20px;
            border: 2px solid Teal;
        }
        #cancel {
            background-color: darkred;
            color: white;
        }
        table {
            text-align: center;
            margin-left: 70px;
        }
        hr
        {
            margin-left: 150px;
        }
        
    </style>
</head>
<body>
<?php
    include 'sideNav.php';
    require 'C:\xampp\htdocs\ClinicProject\Classes\User.php';
    require 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
    include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
	/*$Receptionist=new Receptionist;
	$arr=$Receptionist->confirmAppointment() ;*/
	$arr=databaseReceptionistReader();
    //read here
       
echo "<form name='ConfirmAppointments' action='' method='post'>";
    echo" <h1 class='header'>Confirm Appointments</h1>";
    
echo"<div class='container'>";
echo" <div class='col-50'>";  
        
    echo"<hr >
    <table class='table table-light table-striped table-hover'>
        <thead class='thead-dark'>
        <tr>
            <th>ID</th>
            <th>DoctorID</th>
            <th>PatientID</th>
            <th>Date</th>
            <th>Type</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>Confirmed</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
       
        
		for($i=0;$i<sizeOf($arr);$i++)
		{
		echo "<tr>";
		echo "<td>".$arr[$i]->ID."</td>";
		echo "<td>".$arr[$i]->doctorID."</td>";
		echo "<td>".$arr[$i]->patientID."</td>";
		echo "<td>".$arr[$i]->date."</td>";
		echo "<td>".$arr[$i]->type."</td>";
		echo "<td>".$arr[$i]->startTime."</td>";
		echo "<td>".$arr[$i]->endTime."</td>";
		echo "<td>".$arr[$i]->confirmed."</td>";
		echo "<td><input type='checkbox' name='check[]' value='".$arr[$i]->ID."'></td>";
		echo "</tr>";
		}
		echo"</table>";
		echo "<input type='submit' value='Confirm' name='Confirm' id='confirm'>";
		if(isset($_POST["Confirm"]))
		{
			
			$check=$_POST["check"];
			Check($check);
		}
    echo"</div>";
    echo"</div>";
    
    

echo"</form>";


?>
</body>
</html>