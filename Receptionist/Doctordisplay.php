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
        /***********************************/
        .container {
            padding-left: 170px;
            width: 100%;
        }
        .table {
            font-size: 15px;
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
        h1{
            width : 100%;
            text-align: center;
            font-size: 40px;
            background-color: #111;
            color: white;
            padding-bottom: 7px;
        }
        input[type="submit"] {
            width: 100px;
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
            border: 2px solid Teal;
        }
       /* #edit {
            background-color: yellow;
            color: white;
        }*/
        #cancel
        {
           background-color: darkred;
            color: white; 
        }
        table {
            text-align: center;
        }
        hr
        {
            margin-left: 150px;
        }
        #add{
            background-color: green;
            color: white; 
            margin-left: 400px;
            width:150px;
        }
        
    </style>
    </head>
<body>
<?php
    include 'sideNav.php';
    require 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php'; 
    include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; 
    ob_start();
    session_start();
	/*$doctor=new Doctor;
	$doctorarr=$doctor->cancelDoctor();*/
	$doctorarr=databaseReceptionistDoctorReader();
    //read here
 
    echo "<form name='Docotors' action='' method='post'>";
    
echo"<div class='container'>";
echo" <h1>Doctors</h1>";
echo" <div class='col-50'>";  
        
    echo"<hr>
    <table class='table table-light table-striped table-hover'>
        <thead class='thead-dark'>
        <tr>
            <th>DoctorID</th>
            <th>FullName</th>
            <th>Age</th>
            <th>Telephone</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th></th>
            <th></th>
            
        </tr>
        </thead>
        <tbody>";

		for($i=0;$i<sizeof($doctorarr);$i++)
		{
		echo "<tr>";
		echo "<td>".$doctorarr[$i]->ID."</td>";
		echo "<td>".$doctorarr[$i]->fullName."</td>";
		echo "<td>".$doctorarr[$i]->dob."</td>";
		echo "<td>".$doctorarr[$i]->telephone."</td>";
		echo "<td>".$doctorarr[$i]->username."</td>";
		echo "<td>".$doctorarr[$i]->password."</td>";
        echo "<td>".$doctorarr[$i]->email."</td>";
        echo "<td><input type='submit' id='edit' value='Edit' name='e_".$doctorarr[$i]->ID."'></td>"; 
       echo "<td><input type='submit' id='cancel' value='Cancel' name='c_".$doctorarr[$i]->ID."'></td>";
		//echo "<td><input type='checkbox' name='check[]' value='".$doctorarr[$i]->ID."'></td>";
		echo "</tr>";
		}
        
		echo"</tbody></table>";
        echo "<input type='submit' value='Add' id='add' name='add'>";
        echo "</div></div>";
    //echo"<script>console.log('".sizeof($doctorarr)."')</script>";
   /* for($i=0;$i<sizeof($doctorarr);$i++)
    {
        //if(isset($_POST['c_'.$doctorarr[$y]->ID]))
        {
            echo"<script>console.log('".$i."')</script>";
        }
    }*/
    if(isset($_POST['add'])){
        header("Location: AddDoctorForm.php");
    }
    for($y=0;$y<sizeof($doctorarr);$y++)
    {
		if(isset($_POST['c_'.$doctorarr[$y]->ID])){
			//$check=$_POST["check"];
			//Cancel($check);
            Cancel($doctorarr[$y]->ID);
            echo '<script>javascript:history.go(-1)</script>';
        }
        else if(isset($_POST['e_'.$doctorarr[$y]->ID])){
            $_SESSION['userToEdit'] = $doctorarr[$y];
            header("Location: EditDoctorForm.php");
        }
		
    }
echo"</form>";


?>
</body>
</html>   