<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title> Bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            background-image: url("https://t4.ftcdn.net/jpg/01/08/73/85/240_F_108738548_APV041nyY7usjrh15iQH22x8yEY7PzOP.jpg");
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
    .container {
            padding-left: 170px;
            width: 100%;
        }
        .table {
            font-size: 15px;
        }
        
        .header {
            text-align: center;
            font-size: 40px;
            background-color: #111;
            color: white;
            padding-bottom: 7px;
        }
        input[type="submit"] {
            width: 85%;
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
        #cancel {
            background-color: darkred;
            color: white;
        }
        table {
            text-align: center;
        }
        .color
            {
                color: white;
            }
        .header1{
            text-align: center;
            font-size: 25px;
            color: white;
            padding-bottom: 7px;
            margin-left: 100px;
            
        }
        #search
        {
            margin-left: 30px;
            background-color: green;
            color: white; 
            width:90px;
        }
        .select
        {
            width: 110px;
            background-color: black;
            color: white;
            font-size: 18px;
            height: 30px;
            margin-bottom: 10px;
        }
        .line
        {
            margin-left: 130px;
        }
        </style>
    
  </head>
    <body>
        
<?php
include 'sideNav.php';
require 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
require 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php';
require 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
require 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
include 'C:\xampp\htdocs\ClinicProject\Database\database.php';

	/*$Receptionist=new Receptionist;
	$arr=$Receptionist->confirmAppointment() ;*/
	$receptionist = new Receptionist;
    $doctorarr=databaseReceptionistDoctorReader();
	$arr = array();

    //read here


        echo "<form action='' method='post'>";
		
        echo"<div class='container'>";
        echo "<h1 class='header'>Issue Bill</h1>";
        echo"<hr class='line'>";
        echo"<span class='header1'> Doctor Name: </span>
        <select class='select'name='doctorSearch'>";
        for($i=0;$i<sizeOf($doctorarr);$i++)
		{
            
        echo"<option value='".$doctorarr[$i]->ID."'>".$doctorarr[$i]->ID." - ".$doctorarr[$i]->fullName."</option>";
        }
        echo"</select>";
        echo"<input type='submit' id='search'name='search' value='Search'>";
        echo"<br><br><br>";
        echo " </form> ";
        if(isset($_POST["search"]))
        {
            echo "<form action='' method='post'>";
            $arr=databaseReceptionistAppointmentDoctoridReader($_POST['doctorSearch']);
            echo "<input type='hidden' name='docID' value='".$_POST['doctorSearch']."'>";
           // echo("Count = ".count($arr));
            echo "<table class='table table-light table-striped table-hover'>";
            echo" <thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>DoctorID</th>";
            echo "<th>PatientID</th>";
            echo "<th>Date</th>";
            echo "<th>Type</th>";
            echo "<th>StartTime</th>";
            echo "<th>EndTime</th>";
            echo "<th>Confirmed</th>";
             echo "<th>Cost</th>";    
            echo "</tr>";

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
                echo "<td><input type='text' name='".$arr[$i]->ID."' id='".$arr[$i]->ID."'>
                </td>";
                
                echo "</tr>";
            }
            echo"</table>";
            echo"<input type='submit' name='sav' value='Save'>";
            echo"</div>";
            echo " </form> " ;
		
        
        }
        if(isset($_POST['sav']))
        {
            $arr=databaseReceptionistAppointmentDoctoridReader($_POST['docID']);
            for($i=0;$i<sizeof($arr);$i++)
            {
                if(isset($_POST[''.$arr[$i]->ID]) && strlen($_POST[''.$arr[$i]->ID]) > 0)
                {
                    /*echo "<script>console.log('".$_POST[''.$arr[$i]->ID]."')</script>";
                    echo "<script>console.log('".$arr[$i]->ID."')</script>";*/
                    $receptionist->issueBill($_POST[''.$arr[$i]->ID] , $arr[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

        
		
        



?>
        
</body>
</html>