<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title> Inquiries</title>
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
        #respond {
            width: 30%;
            margin-bottom: 20px;
            margin-left: 300px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: DarkGreen;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
        }
        #respond:hover {
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
        }
        textarea
        {
            margin-left: 305px;
        }
    </style>
  </head>
<body>
	<?php
    include 'sideNav.php';
    include 'C:\xampp\htdocs\ClinicProject\Classes\User.php';
    include 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
    session_start();
    require 'C:\xampp\htdocs\ClinicProject\Classes\Inquiry.php';
	include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
    /*$inquiry=new Inquiry;
	$inquiryArr=$inquiry->respondToInquiries($inquiryID);*/
    $inquiryArr=databaseReceptionistInquiryReader();
    

    echo "<form name='RespondToInquiries' action='' method='post'>";
    
echo"<div class='container'>";
echo" <h1 class='header'>Respond To Inquiries</h1>";
        
    echo"<hr>
    <table class='table table-light table-striped table-hover'>
        <thead class='thead-dark'>
        <tr>
            <th>ID</th>
            <th>PatientID</th>
            <th>ReceptionistID</th>
            <th>InquiryContent</th>
            <th>Respond</th>
            <th>Answered</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
	
		for($i=0;$i<sizeOf($inquiryArr);$i++)
		{
		echo "<tr>";
		echo "<td>".$inquiryArr[$i]->ID."</td>";
		echo "<td>".$inquiryArr[$i]->patientID."</td>";
		echo "<td>".$inquiryArr[$i]->receptionistID."</td>";
		echo "<td>".$inquiryArr[$i]->content."</td>";
		echo "<td>".$inquiryArr[$i]->respond."</td>";
		echo "<td>".$inquiryArr[$i]->answered."</td>";
		echo "<td><input type='radio' value='".$inquiryArr[$i]->ID."' name='Respond[]'></td>";
		echo "</tr>";
        }
        echo "</tbody>";
		echo "</table>";
		
		/*if(isset($_POST["Respond"]))
		{*/
			if(sizeof($inquiryArr) > 0){
                echo "<textarea rows='4' cols='80' name='comment'  placeholder='Enter Your Message'></textarea>";
                //$temp=$_POST["Respond"];
                echo"<br><br>";
                echo "<input type='submit'name='done' id='respond' value='Respond'/>";
            }
			if(isset($_POST['done']))
			{
					
			$inquiry = new Inquiry;
            /*if(empty($_POST['comment']))
                echo "<script type='text/javascript'>alert('Please Enter Your Message');</script>";
            else
				*/
				
                $inquiry->respond =$_POST['comment'] ;
				$inquiry->ID=$_POST['Respond'][0];
                //echo"<script>console.log('".$inquiry->ID."')</script>";
				UpdateInquiry($inquiry->respond,$inquiry->ID);
                echo '<script>javascript:history.go(-1)</script>';
			}
		echo"</div>";
		echo"</form>";
	?>
	
	</body>

</html>