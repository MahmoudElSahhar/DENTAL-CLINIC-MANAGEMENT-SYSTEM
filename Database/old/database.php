<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


function startConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic";

    // Create connection
    $GLOBALS['conn'] = new mysqli($servername, $username, $password, $dbname);
}

///////////////////////////////////////////////////////////Read///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Read///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Read///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Read///////////////////////////////////////////////////////////

function databaseLogIn($username, $password){
    startConnection();
    $sql="select * from user where Username = '".$username."' and Password = '".$password."'";
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $userType = $row['UserType'];
        session_start();
        
        if($userType == 1){
            $_SESSION['user'] = new Doctor;
            $_SESSION['user']->Schedule = readSchedule($row['ID']);
            $_SESSION['user']->Excuses = readExcuseForDoctor($row['ID']);
            $_SESSION['user']->Appointments = readDoctorAppointment($row['ID']);
        }
        else if($userType == 2){
            $_SESSION['user'] = new Patient;
            $_SESSION['user']->Appointments = getPatientAppointments($row['ID']);
            $_SESSION['user']->Analysis = getPatientAnalysis($row['ID']);
            $_SESSION['user']->Prescriptions = getPatientPrescriptions($row['ID']);
        }
        else if($userType == 3){
            $_SESSION['user'] = new Receptionist;
        }

        $_SESSION['user']->ID = $row['ID'];
        $_SESSION['user']->fullName = $row['FullName'];
        $_SESSION['user']->dob = $row['DOB'];
        $_SESSION['user']->telephone = $row['Telephone'];
        $_SESSION['user']->email = $row['Email'];
        $_SESSION['user']->username = $username;
        $_SESSION['user']->password = $password;
        return $userType;
    }
    else{
        return false;
    }
}

function getPatientAppointments($patientID){
    startConnection();
    $sql="select * from appointment where PatientID =" . $patientID;
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $count = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $appointment = new Appointment;
            $appointment->ID = $row['ID'];
            $appointment->date = $row['Date'];
            $appointment->type = $row['Type'];
            $appointment->startTime = $row['StartTime'];
            $appointment->endTime = $row['EndTime'];
            $appointment->patientID = $row['PatientID'];
            $appointment->doctorID = $row['DoctorID'];
            $appointment->confirmed = $row['Confirmed'];
            //read prescription object
            if($row['PrescriptionID'] != NULL)
                $appointment->Prescription = getPrescription($row['PrescriptionID']);
            //read bill object
            if($row['BillID'] != NULL)
                $appointment->Bill = getBill($row['BillID']);
            $arr[$count] = $appointment;
            $count++;
        }            
    }
    return $arr;
}

function getPrescription($prescriptionID){
    $prescription = new Prescription;

    $sql="select * from prescription where ID =" . $prescriptionID;
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $prescription->prescriptionID = $row['ID'];
        $prescription->patientID = $row['PatientID'];
        $prescription->content = $row['Content'];
    }
    return $prescription;
}

function getBill($billID){
    $bill = new Bill;

    $sql="select * from bill where ID =" . $billID;
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $bill->billID = $row['ID'];
        $bill->cost = $row['Cost'];
    }
    return $bill;
}

function getInquiry($patientID){
    startConnection();
    $sql="select * from inquiry where PatientID =".$patientID;
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $count=0;
    $arr = array();
    

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $inquiry = new Inquiry;
            $inquiry->ID = $row['ID'];
            $inquiry->patientID = $row['PatientID'];
            $inquiry->receptionistID = $row['ReseptionistID'];
            $inquiry->content = $row['InquiryContent'];
            $inquiry->respond = $row['Respond'];
            $inquiry->answered = $row['Answered'];

            $arr[$count] = $inquiry;
            $count++;
        }
    }
    return $arr;
}

function getPatientAnalysis($patientID){
    $sql="select * from analysis where PatientID =" . $patientID;
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $count = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $analysis = new Analysis;
            $analysis->analysisID = $row['ID'];
            $analysis->patientID = $row['PatientID'];
            $analysis->content = $row['Content'];
            $arr[$count] = $analysis;
            $count++;
        }            
    }
    return $arr;
}

function getPatientPrescriptions($patientID){
    $sql="select * from prescriptions where PatientID =" . $patientID;
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $count = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $prescription = new Prescription;
            $prescription->prescriptionID = $row['ID'];
            $prescription->patientID = $row['PatientID'];
            $prescription->content = $row['Content'];
            $arr[$count] = $prescription;
            $count++;
        }            
    }
    return $arr;
}

function getDoctor($doctorID){
    startConnection();
    $doctor = new Doctor;
    $appointmentArr = array();

    $sql="select * from user where ID =" . $doctorID;
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $doctor->ID = $row['ID'];
        $doctor->fullName = $row['FullName'];
        $doctor->dob = $row['DOB'];
        $doctor->telephone = $row['Telephone'];
        $doctor->username = $row['Username'];
        $doctor->password = $row['Password'];
        //read Appointment object
        $doctor->Appointments = getAppointment($doctorID);
        
        $doctor->Schedule = getSchedule($doctorID);
        
    }
    return $doctor;
}

function getSchedule($doctorID){
    $sql="select * from doctor_availability where DoctorID =" . $doctorID;
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $schedule = new Schedule;

    $count = 0;
    while($sch = mysqli_fetch_array($result))
    {
        $schedule->days[$count] = $sch['Day'];
        $schedule->startTime[$sch['Day']] = $sch['StartTime'];
        $schedule->endTime[$sch['Day']] = $sch['EndTime'];
        $count++;
    }
    return $schedule;
}

function getAppointment($appointmentID){
    $appointment = new Appointment;

    $sql="select * from appointment where ID =" . $appointmentID;
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $appointment->ID = $row['ID'];
        $appointment->date = $row['Date'];
        $appointment->type = $row['Type'];
        $appointment->startTime = $row['StartTime'];
        $appointment->endTime = $row['EndTime'];
        $appointment->patientID = $row['PatientID'];
        $appointment->doctorID = $row['DoctorID'];
        $appointment->confirmed = $row['Confirmed'];
        //read prescription object
        if($row['PrescriptionID'] != NULL)
            $appointment->Prescription = getPrescription($row['PrescriptionID']);
        //read bill object
        if($row['BillID'] != NULL)
            $appointment->Bill = getBill($row['BillID']);
    }
    return $appointment;
}

function getDoctorNames(){
    startConnection();
    $doctor = new Doctor;
    $appointmentArr = array();

    $sql="select * from user where UserType =1";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $counter = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $doctor = new Doctor;
            $doctor->ID = $row['ID'];
            $doctor->fullName = $row['FullName'];
            $arr[$counter] = $doctor;
            $counter++;
        }
    }
    return $arr;
}

function getAllUsers(){
    startConnection();

    $sql="select * from user";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $counter = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $user = new User;
            $user->ID = $row['ID'];
            $user->fullName = $row['FullName'];
            $user->email = $row['Email'];
            $user->dob = $row['DOB'];
            $user->telephone = $row['Telephone'];
            $user->username = $row['Username'];
            $user->password = $row['Password'];
            $user->userType = $row['UserType'];
            $arr[$counter] = $user;
            $counter++;
        }
    }
    return $arr;
}

function getAllDoctors(){
    startConnection();

    $sql="select * from user where UserType = 1";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $counter = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $doc = new Doctor;
            $doc->ID = $row['ID'];
            $doc->fullName = $row['FullName'];
            $doc->email = $row['Email'];
            $doc->dob = $row['DOB'];
            $doc->telephone = $row['Telephone'];
            $doc->username = $row['Username'];
            $doc->password = $row['Password'];
            $doc->userType = $row['UserType'];
            $arr[$counter] = $doc;
            $counter++;
        }
    }
    return $arr;
}

function getPatientNames(){
    startConnection();
    $patient = new Patient;

    $sql="select * from user where UserType = 2";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $arr = array();
    $counter = 0;

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $patient = new Patient;
            $patient->ID = $row['ID'];
            $patient->fullName = $row['FullName'];
            $arr[$counter] = $patient;
            $counter++;
        }
    }
    return $arr;
}

function readSchedule($doctorID){
    $sql = "select * FROM doctor_availability WHERE DoctorID =".$doctorID."";
    $result = mysqli_query($GLOBALS['conn'],$sql);
    $schedule = new Schedule;
    $schedule->days = array_fill(0, 7, NULL);
    $schedule->startTime = array_fill(0, 7, NULL);
    $schedule->endTime = array_fill(0, 7, NULL);
    

    while($row = mysqli_fetch_array($result)){
        $schedule->days[$row['Day']] = $row['Day'];
        $schedule->startTime[$row['Day']] = $row['StartTime'];
        $schedule->endTime[$row['Day']] = $row['EndTime']; 
    }

    return $schedule;

}

function readExcuseForPatient($doctorID){
    $today = date("Y-m-d");
    $week = date("Y-m-d", strtotime("+7 day", strtotime(date("Y-m-d"))));
    
    $sql = "select * FROM doctor_excuse WHERE Date BETWEEN '" .$today. "' and '".$week."' and DoctorID ='".$doctorID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    $excuses = array();
    if(mysqli_num_rows($result) > 0){
        $excuses = array_fill(0,mysqli_num_rows($result),NULL); 
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $excuses[$i] = new Excuse;
            $excuses[$i]->ID = $row['ID'];
            $excuses[$i]->doctorID = $row['DoctorID'];
            $excuses[$i]->date = $row['Date'];
            $excuses[$i]->startTime = $row['StartTime'];
            $excuses[$i]->endTime = $row['EndTime'];
            $i++;
        } 
    }   
    return $excuses;
}

function readExcuseForDoctor($doctorID){
    $sql = "select * FROM doctor_excuse WHERE DoctorID =".$doctorID."";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    $excuses = array();
    if(mysqli_num_rows($result) > 0){
        $excuses = array_fill(0,mysqli_num_rows($result),NULL); 
        $i = 0;
        while($row = mysqli_fetch_array($result)){
            $excuses[$i] = new Excuse;
            $excuses[$i]->ID = $row['ID'];
            $excuses[$i]->doctorID = $row['DoctorID'];
            $excuses[$i]->date = $row['Date'];
            $excuses[$i]->startTime = $row['StartTime'];
            $excuses[$i]->endTime = $row['EndTime'];
            $i++;
        } 
    } 

    return $excuses;    
}

function readDoctorAppointment($doctorID){
    $sql = "select * from appointment where DoctorID = ".$doctorID."";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    $appointments = array();
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $appointments[$i] = new Appointment;
        $appointments[$i]->ID = $row['ID'];
        $appointments[$i]->date = $row['Date'];
        $appointments[$i]->type = $row['Type'];
        $appointments[$i]->startTime = $row['StartTime'];
        $appointments[$i]->endTime = $row['EndTime'];
        $appointments[$i]->patientID = $row['PatientID'];
        $appointments[$i]->doctorID = $row['DoctorID'];
        $appointments[$i]->confirmed = $row['Confirmed'];

        if($row['PrescriptionID'] != NULL){
            $appointments[$i]->Prescription = new Prescription;
            $appointments[$i]->Prescription->ID = $row['PrescriptionID'];
            $presSql = "select * from prescription where ID = ".$appointments[$i]->Prescription->ID."";
            $presResult = mysqli_query($GLOBALS['conn'],$presSql);
            $presRow = mysqli_fetch_array($presResult);
            $appointments[$i]->Prescription->content = $presRow['Content'];
        }

        if($row['BillID'] != NULL){
            $appointments[$i]->Bill = new Bill;
            $appointments[$i]->Bill->billID = $row['BillID'];
            $billSql = "select Cost from bill where ID = ".$appointments[$i]->Bill->ID."";
            $billResult = mysqli_query($GLOBALS['conn'],$billSql);
            $billRow = mysqli_fetch_array($billResult);
            $appointments[$i]->Bill->cost = $billRow['Cost'];
        }

        $i++;
    }
    return $appointments;
}

function databaseAppointmentsReader($doctorID){
    $arr = array();
    $counter = 0;

    $sql="select * from appointment where Date >= '" . date("Y-m-d") . "' and DoctorID =" . $doctorID;
    $result=mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $appointment = new Appointment;
            $appointment->doctorID = $row['DoctorID'];
            $appointment->patientID = $row['PatientID'];
            $appointment->ID = $row['ID'];
            $appointment->date = $row['Date'];
            $appointment->type = $row['Type'];
            $appointment->startTime = $row['StartTime'];
            $appointment->endTime = $row['EndTime'];
            $appointment->confirmed = $row['Confirmed'];
            $arr[$counter] = $appointment;
            $counter++;
        }
    }
    return $arr;
}

//////////////////////////////////////////////////REMOVE//////////////////////////////////////////////////

function databaseRemovePatient($patientID){
    $sql="Delete from inquiry where PatientID ='" . $patientID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from appointment where PatientID ='" . $patientID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from analysis where PatientID ='" . $patientID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from user where ID ='" . $patientID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function RemoveAppointment($appointmentId){
    $sql="select * from appointment where ID ='" . $appointmentId . "'";
    $result = mysqli_query($GLOBALS['conn'],$sql);
    $row = mysqli_fetch_array($result);
    $sql="Delete from bill where ID ='" . $row['BillID'] . "'";
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from prescription where ID ='" . $row['PrescriptionID'] . "'";
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from appointment where ID ='" . $appointmentId . "'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function RemoveAnalysis($analysisID){
    startConnection();
    $sql="Delete from analysis where ID ='" . $analysisID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function RemovePrescription($prescriptionID){
    startConnection();
    $sql="Update appointment set PrescriptionID = NULL where PrescriptionID =".$prescriptionID;
    mysqli_query($GLOBALS['conn'],$sql);
    $sql="Delete from prescription where ID ='" . $prescriptionID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function RemoveInquiry($inquiryID){
    startConnection();
    $sql="Delete from inquiry where ID ='" . $inquiryID . "'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function deleteExcuse($excuseID){
    startConnection();
    $sql = "delete FROM doctor_excuse WHERE ID = ".$excuseID."";
    mysqli_query($GLOBALS['conn'],$sql);
}

function deleteDoctorAvailability($doctorID){
    $sql = "delete FROM doctor_availability WHERE DoctorID = ".$doctorID."";
    mysqli_query($GLOBALS['conn'],$sql);
}

function removePrescriptionForDoctor($presID , $appID){
    $sql = "update appointment set PrescriptionID = NULL WHERE ID = '".$appID."'";
    mysqli_query($GLOBALS['conn'],$sql);

    $sql = "delete FROM prescription WHERE ID = ".$presID."";
    mysqli_query($GLOBALS['conn'],$sql);
}

function readAppointmentsToConfirm(){
    startConnection();
    $tomorrow = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d"))));

    $sql="select * from appointment where Date ='".$tomorrow."' and Confirmed = '0'";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    $counter = 0;
    $arr = array();

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $appointment = new Appointment;
            $appointment->doctorID = $row['DoctorID'];
            $appointment->patientID = $row['PatientID'];
            $appointment->ID = $row['ID'];
            $appointment->date = $row['Date'];
            $appointment->type = $row['Type'];
            $appointment->startTime = $row['StartTime'];
            $appointment->endTime = $row['EndTime'];
            $appointment->confirmed = $row['Confirmed'];
            $arr[$counter] = $appointment;
            $counter++;
        }
    }
    return $arr;
}

function checkExcuses($date , $startTime , $endTime){
    startConnection();
    $ids = array();
    $i = 0;

    $sql="select * from doctor_excuse where Date ='".$date."' and((StartTime < '".$startTime."' and EndTime > '".$startTime."')
                                                               OR (StartTime >= '".$startTime."' and EndTime <= '".$endTime."')
                                                               OR (StartTime < '".$endTime."' and EndTime > '".$endTime."'))";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $ids[$i] = $row['ID'];
            $i++;
        }
        return ($ids);
    }
    else{
        return 0;
    }
}


///////////////////////////////////////////////////////////Write///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Write///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Write///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////Write///////////////////////////////////////////////////////////

function databasePatientWriter($patient){
    $sql = "select ID from user_type where UserType = 'Patient'";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    $userType = mysqli_fetch_array($result);
    $sql="insert into user(FullName,DOB,Telephone,Username,Password,Email,UserType) values('"
        .$patient->fullName."','".$patient->dob."','".$patient->telephone."','".$patient->username."','".$patient->password."'
        ,'".$patient->email."','".$userType['ID']."')";
    mysqli_query($GLOBALS['conn'],$sql);
}

function databaseUpdatePatient($patient){
    echo "
        <script>
            alert(".$patient->telephone.");
        </script>
    ";
    $sql="update user set FullName ='".$patient->fullName."',DOB ='".$patient->dob."'
    ,Telephone ='".$patient->telephone."',Username ='".$patient->username."',Password ='".$patient->password.
    "',email ='".$patient->email."' where ID ='".$patient->ID."'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function writeAppointment($appointment){
    $sql="insert into appointment(DoctorID, PatientID, PrescriptionID, BillID, Date, Type, StartTime, EndTime, Confirmed) 
    values('".$appointment->doctorID."','".$appointment->patientID."', NULL ,NULL ,'".$appointment->date.
        "','".$appointment->type."','".$appointment->startTime."','".$appointment->endTime."','0')";
    mysqli_query($GLOBALS['conn'],$sql);
}

function databaseAnalysisWriter($analysis){
    startConnection();
    $sql="insert into analysis(PatientID,Content) values('".$analysis->patientID."','".$analysis->content."')";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    return $result;
}

function databasePrescriptionWriter($prescription){
    startConnection();
    $sql="insert into prescription(Content) values('".$prescription->content."')";
    $result=mysqli_query($GLOBALS['conn'],$sql);
    return "done";
}

function databaseInquiryWriter($inquiry){
    startConnection();
    $sql="insert into inquiry(PatientID,ReseptionistID,InquiryContent,Respond,Answered) values('".$inquiry->patientID.
    "',NULL,'".$inquiry->content."',NULL,'false')";
    mysqli_query($GLOBALS['conn'],$sql);
}

function writeDoctor($doctor){
    $userType = "select ID from user_type where UserType = 'Doctor'";
    $result = mysqli_query($GLOBALS['conn'],$userType);
    $ut = mysqli_fetch_array($result);
    $sql="insert into user(FullName,DOB,Telephone,Username,Password,Email,UserType)
          values('".$doctor->fullName."','".$doctor->dob."','".$doctor->telephone."','".$doctor->username."','".$doctor->password."','".$doctor->email."','".$ut['ID']."')";
    mysqli_query($GLOBALS['conn'],$sql);
    return($GLOBALS['conn']->insert_id);
}

function writeDoctorAvailability($doctorID , $schedule){
    for($i = 0 ; $i < count($schedule->days) ;$i++){
        $sql="insert into doctor_availability(DoctorID,Day,StartTime,EndTime)
              values('".$doctorID."','".$schedule->days[$i]."','".$schedule->startTime[$schedule->days[$i]]."','".$schedule->endTime[$schedule->days[$i]]."')";
        mysqli_query($GLOBALS['conn'],$sql);
    }
}

function writeDoctorExcuse($excuse){
    $sql="insert into doctor_excuse(DoctorID,Date,StartTime,EndTime)
          values('".$excuse->doctorID."','".$excuse->date."','".$excuse->startTime."','".$excuse->endTime."')";
    mysqli_query($GLOBALS['conn'],$sql);

    //session_start();
    array_push($_SESSION['user']->Excuses , $excuse);
}

function updateExcuse($e){
    $sql = "update doctor_excuse set DoctorID='".$e->doctorID."',Date='".$e->date."',StartTime='".$e->startTime."',EndTime='".$e->endTime."' WHERE ID ='".$e->ID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);
}

function writePrescription($appointmentID , $p){
    $sql="insert into prescription(Content) values('".$p->content."')";
    mysqli_query($GLOBALS['conn'],$sql);

    $presID = $GLOBALS['conn']->insert_id;
    $p->ID = $presID;
    $_SESSION['user']->Appointments[$_SESSION['appointmentIndex']]->Prescription = $p;

    $sql = "update appointment set PrescriptionID ='".$presID."' WHERE ID = '".$appointmentID."'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function editPrescription($pres){
    $sql = "update prescription set Content ='".$pres->content."' WHERE ID = '".$pres->ID."'";
    mysqli_query($GLOBALS['conn'],$sql);
}

function makeAppointmentConfirmed($appointmentID){
    startConnection();
    $sql = "update appointment set Confirmed = '1' WHERE ID = '".$appointmentID."'";
    mysqli_query($GLOBALS['conn'],$sql);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function updateUserAccount($user){
    startConnection();
    $sql = "update user set FullName='".$user->fullName."',DOB='".$user->dob."',Telephone='".$user->telephone."',Email='".$user->email."',Username='".$user->username."',Password='".$user->password."'  WHERE ID ='".$user->ID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);
}

function deleteDoctorAccount($doctorID){
    startConnection();

    //Schedule
    $sql = "delete from doctor_availability where DoctorID = '".$doctorID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    //Excuses
    $sql = "delete from doctor_excuse where DoctorID = '".$doctorID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    //Appointments
    $sql = "select * from appointment where DoctorID = '".$doctorID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);

    $counter = 0;
    $arr = array();
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $arr[$counter] = $row['ID'];
            $counter++;
        }
    }

    for($i = 0 ; $i < count($arr) ; $i++){
        RemoveAppointment($arr[$i]);
    }

    //Acoount
    $sql = "delete from user where ID = '".$doctorID."'";
    $result = mysqli_query($GLOBALS['conn'],$sql);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////Reader///////////////////////////////////////////////////////////////////
function databaseReceptionistBillReader(){
    //require 'Bill.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="SELECT * FROM bill  ";
    $result=mysqli_query($conn,$sql);
    $BillArr=array();
    $counter=0;
    while($row=mysqli_fetch_array($result))
    {
        $bill=new Bill;
        $bill->billID=$row["ID"];
        /*	$bill->appointmentID=$row["AppointmentID"];  */
        //$bill->cost=$row["Cost"];
        $BillArr[$counter]=$bill;
        $counter++;
    }
    return $BillArr;
}

function databaseReceptionistReader(){
		require 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM appointment where Confirmed =0";
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

function databaseReceptionistDoctorReader(){
		
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM user where UserType='1'";
        $result=mysqli_query($conn,$sql);
        //return $result;//
		$doctorarr=array();
		$counter=0;
		while($row=mysqli_fetch_array($result))
		{
			$doctor=new Doctor;
			$doctor->ID=$row["ID"];
			$doctor->fullName=$row["FullName"];
			$doctor->age=$row["DOB"];
			$doctor->telephone=$row["Telephone"];
			$doctor->username=$row["Username"];
			$doctor->password=$row["Password"];
            $doctor->email=$row["Email"];
            $doctor->userType=$row["UserType"];
			
			$doctorarr[$counter]=$doctor;
			$counter++;
		}
		return $doctorarr;
}

function databaseReceptionistAppointmentDoctoridReader($doctorID){
		//require 'Doctor.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * fROM appointment where DoctorID='".$doctorID."'";
        $result=mysqli_query($conn,$sql);
        //return $result;//
		$doctorarr=array();
		$counter=0;
		while($row=mysqli_fetch_array($result))
		{
			$doctor=new Appointment;
			$doctor->ID=$row["ID"];
			$doctor->doctorID=$row["DoctorID"];
			$doctor->patientID=$row["PatientID"];
			$doctor->type=$row["Type"];
			$doctor->date=$row["Date"];
			$doctor->startTime=$row["StartTime"];
            $doctor->endTime=$row["EndTime"];
            $doctor->confirmed=$row["Confirmed"];
			
			$doctorarr[$counter]=$doctor;
			$counter++;
		}
		return $doctorarr;
}

function databaseReceptionistInquiryReader(){
		//require 'Inquiry.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM inquiry ";
        $result=mysqli_query($conn,$sql);
		$inquiryArr=array();
		$counter=0;
		while($row=mysqli_fetch_array($result))
		{
			$inquiry=new Inquiry;
			$inquiry->inquiryID=$row["ID"];
			$inquiry->patientID=$row["PatientID"];
			$inquiry->reseptionistID=$row["ReseptionistID"];
			$inquiry->content=$row["InquiryContent"];
			$inquiry->respond=$row["Respond"];
			$inquiry->answered=$row["Answered"];
			$inquiryArr[$counter]=$inquiry;
			$counter++;
		}
		return $inquiryArr;
}

////////////////////////////////////////////Writer//////////////////////////////////////////////////////////////////////////
function updateReceptionist($receptionist){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="update user set FullName ='".$receptionist->fullName."',DOB ='".$receptionist->age."'
        ,Telephone ='".$receptionist->telephone."',Username ='".$receptionist->username."',Password ='".$receptionist->password.
        "',email ='".$receptionist->email."' where ID ='".$receptionist->ID."'";
    $result=mysqli_query($conn,$sql);
}

function Check($check){
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
			
			$store=implode(",",$check);
			mysqli_query($conn,"update appointment set confirmed=1 where ID in($store)");
}

function Cancel($doctorID){
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        $conn = new mysqli($servername, $username, $password, $dbname);
			
			mysqli_query($conn,"delete from user where ID = '".$doctorID."'");
}

function writeBill($billCost, $appointmentID){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="insert into bill(Cost) values('".$billCost."')";
    mysqli_query($conn,$sql);
    
    $billID = $conn->insert_id;
    $sql = "update appointment set BillID='".$billID."' where ID = '".$appointmentID."'";	
    mysqli_query($conn,$sql);
}

function UpdateInquiry($respond,$inquiryID){
    
    $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //echo "tettt".$respond.$inquiryID;
        $sql = "update inquiry set Answered=1,Respond='".$respond."', ReseptionistID='".$_SESSION['user']->ID."' where ID='".$inquiryID."'";	
        mysqli_query($conn,$sql);
}

?>