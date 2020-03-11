<html>	
<head>
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://localhost/ClinicProject/Receptionist/test.js"></script>
  </head>
<body>
<?php
require 'Bill.php'; 
		include 'databaseWriter.php';
		include 'databaseReader.php';
		/*$bill=new Bill;
   $BillArr= $bill->databaseReceptionistBillReader();*/
    $BillArr=databaseReceptionistBillReader();
echo "<form action='' method='post'>";
		/*echo "ID: <input name='BillId' type='text' />    <br /><br />";*/
		/*echo "AppointmentID: <input name='AppointmentId' type='text' /> ";  */ 
		//echo "<br /><br />";
		echo "Cost: <input name='Cost' type='text' /> 
        <input type='submit' name='Send' value='Send'>
        <br /><br />";
		echo "<table class='table table-striped table-hover'>";
		echo "<tr>";
		echo "<td>ID</td>";
		//echo "<td>AppointmentID</td>";
		echo "<td>Cost</td>";
		echo "</tr>";
		for($i=0;$i<sizeOf($BillArr);$i++)
		{
		echo "<tr>";
		/*echo "<td>".$BillArr[$i]->billID."</td>";*/
		/*echo "<td>".$BillArr[$i]->appointmentID."</td>";*/
		
		echo "<td>".$BillArr[$i]->billID."</td>";
            echo "<td>".$BillArr[$i]->cost."</td>";
		echo "</tr>";
		}
		
		if(isset($_POST["Send"]))
		{
			
			$bill = new Bill;
            
                $bill->billID = $_POST['BillId'];
            
            /*$bill->appointmentID = $_POST['AppointmentId'];*/
			$bill->cost = $_POST['Cost'];
			writeBill($billID);
		}
		echo "</table>";
echo"</form>";
?>
</body>
</html>
