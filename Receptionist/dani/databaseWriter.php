<?php

    function databasePatientWriter($patient){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="insert into patient(PatientID,FirstName,LastName,Age,Telephone,Username,Password) values('".$patient->ID."','"
            .$patient->fullName."','".$patient->fullName."','".$patient->age."','".$patient->telephone
            ."','".$patient->username."','".$patient->password."')";
        $result=mysqli_query($conn,$sql);
        return "done";
    }

    function databaseAnalysisWriter($analysis){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="insert into analysis(AnalysisID,PatientID,Content) values('".$analysis->analysisID."','"
            .$analysis->patientID."','".$analysis->content."')";
        $result=mysqli_query($conn,$sql);
        return "done";
    }

    function databasePrescriptionWriter($prescription){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="insert into prescription(PrescriptionID,AppointmentID,Content) values('".$prescription->prescriptionID."','"
            .$prescription->appointmentID."','".$prescription->content."')";
        $result=mysqli_query($conn,$sql);
        return "done";
    }

    function databaseInquiryWriter($inquiry){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="insert into inquiry(InquiryID,PatientID,ReseptionistID,InquiryContent,Respond,Answered) values('"
            .$inquiry->inquiryID."','".$inquiry->patientID."','".$inquiry->receptionistID."','".$inquiry->content.
            "','NULL','false')";
        $result=mysqli_query($conn,$sql);
        return "done";
    }

    function writeDoctor($doctor){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        $sql="insert into doctor(DoctorID,FirstName,LastName,Age,Telephone,Username,Password)
              values('".$doctor->doctorID."','".$doctor->firstName."','".$doctor->lastName."','".$doctor->age."','".$doctor->telephone."','".$doctor->username."','".$doctor->password."')";
        mysqli_query($conn,$sql);
    
    }
    
    function writeDoctorAvailability($doctor){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        for($i = 0 ; $i < count($doctor->days) ;$i++){
            $sql="insert into doctor_availability(DoctorID,Day,StartTime,EndTime)
                  values('".$doctor->doctorID."','".$doctor->days[$i]."','".$doctor->startTime[$doctor->days[$i]]."','".$doctor->endTime[$doctor->days[$i]]."')";
            mysqli_query($conn,$sql);
        }
    }
function writeReceptionist($receptionist){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="insert into user(FullName,DOB,Telephone,Username,Password,Email,UserType) values('"
            .$receptionist->fullName."','".$receptionist->age."','".$receptionist->telephone
            ."','".$receptionist->username."','".$receptionist->password."','".$receptionist->email."','3')";
        
        $result=mysqli_query($conn,$sql);
    }

	
	function Send($bill , $appointmentID)
	{
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_query($conn,"insert into bill(Cost) values('".$bill->cost."')");
            $billID = $conn->insert_id;
            mysqli_query($conn,"update appointment set BillID values('".$billID."') where ID = '".$appointmentID."'");

			/*$sql = "update bill set BillID ='".$id."',AppointmentID='".$check."',Cost='".$cost."' where AppointmentID='".$check."'";
			mysqli_query($conn,$sql);*/			
	}
	/*function Cancel($check)
	{
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
			
			$store=implode(",",$check);
			mysqli_query($conn,"delete from doctor where DoctorID in($store)");
	}
    */


	function UpdateAppointmentID($check,$billID)
	{
		$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "clinic";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
            $store=implode(",",$check);
			$sql = "update appointment set BillID='".$billID."' where ID in($store)";	
			mysqli_query($conn,$sql);
			
	}
	

?>