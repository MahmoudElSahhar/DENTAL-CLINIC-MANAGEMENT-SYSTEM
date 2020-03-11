
<?php
class Receptionist{
	
    public $ID;                 //int
    public $fullName = '';      //string
    public $age;                //int
    public $telephone;          //string
    public $username = '';      //string
    public $password = '';      //string
    public $email='';           //string
    public $userType='';        //int
function confirmAppointment($check) 
	{
		if(isset($_POST["Confirm"]))
		{
			check($check);
		}
		
	}
	
	function respondToInquiries($inquiryID){
		
		$inquiryArr=databaseReceptionistInquiryReader($inquiryID);
		return $inquiryArr;		
	}
    function issueBill($cost, $appointmentID)
	{
		writeBill($cost, $appointmentID);
	}
	function cancelDoctor()
	{
		$doctorarr=databaseReceptionistDoctorReader();
		return $doctorarr;
	}
	function viewDoctor()
	{
		$doctorarr=databaseReceptionistDoctorReader();
		return $doctorarr;
	}
	
		

		

		


}
?>

