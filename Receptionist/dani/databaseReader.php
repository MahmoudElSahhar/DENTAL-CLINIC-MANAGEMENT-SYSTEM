<?php

    function databasePatientReader($patientUsername, $patientPassword){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="select Password from patient where Username = '" . $patientUsername . "'";
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            if($patientPassword == $row['Password'])
                return $row['Password'];        //if correct password return password in database
        }
        return "Incorrect username or password";
    }
function databaseReceptionistLogin($receptionistUsername, $receptionistPassword){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="select * from user where Username = '" . $receptionistUsername . "'";
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            if($receptionistPassword == $row['Password'])
            {
                $receptionist=new Receptionist;
                $receptionist->fullName = $row['FullName'];
                $receptionist->ID = $row['ID'];
            $receptionist->age = $row['DOB'];
            $receptionist->telephone = $row['Telephone'];
            $receptionist->username = $row['Username'];
            $receptionist->password = $row['Password'];
            $receptionist->email = $row['Email'];
            $receptionist->userType = $row['UserType'];
                
                return $receptionist;
            }
                       
        }
        return false;
    }
    
	function databaseAppointmentsReader()
    {
		require 'Appointment.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM appointment";
        $result=mysqli_query($conn,$sql);
        //return $result;//
		$arr=array();
		$counter=0;
		while($row=mysqli_fetch_array($result))
		{
			$appointment=new Appointment;
			$appointment->ID=$row["ID"];
			$appointment->doctorID=$row["DoctorID"];
			$appointment->patientID=$row["PatientID"];
			$appointment->Prescription=$row["PrescriptionID"];
			$appointment->Bill=$row["BillID"];
			$appointment->date=$row["Date"];
			$appointment->type=$row["Type"];
			$appointment->startTime=$row["StartTime"];
			$appointment->endTime=$row["EndTime"];
			$appointment->confirmed=$row["Confirmed"];
			
			$arr[$counter]=$appointment;
			$counter++;
		}
		return $arr;
    }

	
	/*function databaseReceptionistViewInquiry($inquiryID,$content)
	{
		require 'Inquiry.php';
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "clinic";
	
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "select * from inquiry where InquiryID='".$inquiryID."',InquiryContent='".$content."'";
			$result=mysqli_query($conn,$sql);
			$row=mysql_fetch_array($result);
			$inquiry=new Inquiry;
			$inquiry->inquiryID=$row["InquiryID"];
			$inquiry->patientID=$row["PatientID"];
			$inquiry->reseptionistID=$row["ReseptionistID"];
			$inquiry->content=$row["InquiryContent"];
			$inquiry->respond=$row["Respond"];
			$inquiry->answered=$row["Answered"];
		
		return $inquiry;
	}*/
	
	

function databaseReceptionistAccountReader()
	{
		require 'Receptionist.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM user where UserType='3'";
        $result=mysqli_query($conn,$sql);
        //return $result;//
		$receptionistarr=array();
		$counter=0;
		while($row=mysqli_fetch_array($result))
		{
			$receptionist=new Receptionist;
			$receptionist->ID=$row["ID"];
			$receptionist->fullName=$row["FullName"];
			$receptionist->age=$row["DOB"];
			$receptionist->telephone=$row["Telephone"];
			$receptionist->username=$row["Username"];
			$receptionist->password=$row["Password"];
            $receptionist->email=$row["Email"];
            $receptionist->userType=$row["UserType"];
			
			$receptionistarr[$counter]=$receptionist;
			$counter++;
		}
		return $receptionistarr;
    }
	
	
?>