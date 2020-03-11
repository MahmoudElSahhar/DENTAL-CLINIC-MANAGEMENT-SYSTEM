<?php
//include 'User.php';

class Patient extends User{
    public $Appointments = array();     //array of object
    public $Analysis = array();         //array of object
    public $Prescriptions = array();

    public static function signUp(){
        $patient = new Patient;
        $patient->fullName = $_POST['patientName'];
        $patient->dob = $_POST['patientAge'];
        $patient->telephone = $_POST['patientTelephone'];
        $patient->username = $_POST['patientUsername'];
        $patient->password = $_POST['patientPassword'];
        $patient->email = $_POST['patientEmail'];
        
        databasePatientWriter($patient);
    }

    //DONE
    function reserveAppointment($appointment){
        $Appointments = getAppointmentsByPatientID($_SESSION['user']->ID);
        writeAppointment($appointment);
    }
    //DONE
    function updateAppointment($appointment){
        $Appointments = getAppointmentsByPatientID($_SESSION['user']->ID);
        updateAppointmentByPatient($appointment);
    }
    //DONE
    function cancelAppointment($appointmentID){
        RemoveAppointment($appointmentID);
        echo '<script>javascript:history.go(-1)</script>';
    }

    //DONE
    function uploadAnalysis($content){
        if(isset($_POST['addAnalysis']))
        {    
            $analysis = new Analysis;
            $analysis->patientID = $_SESSION['user']->ID;
            $analysis->content = $content;
            
            databaseAnalysisWriter($analysis);
            $_SESSION['user']->Analysis = getAnalysisByPatientID($_SESSION['user']->ID);

        }
    }
    //DONE
    function viewAnalysis(){
        if(isset($_POST['submitAnalysis']))
        {
            $del = $_POST['checkboxAnalysis'];
            for($i=0;$i < count($del);$i++){
                RemoveAnalysis($del[$i]);
            }
        }
    }
    //DONE
    function updateAnalysis(){
        if(isset($_POST['submitAnalysis']))
        {
            $analysis = new Analysis;
            $analysis->analysisID = $_POST['updateAnalysis'][0];
            $analysis->content = $_POST['textAnalysis'];
            
            databaseUpdateAnalysis($analysis);
        }
    }
    //DONE
    function removeAnalysis($i, $analysisID){
        array_splice($_SESSION['user']->Analysis,$i,1);
        RemoveAnalysis($analysisID);
    }
    //DONE
    function viewBill(){
        if(isset($_POST['submit']))
        {    
            $id = $_POST['appoints'];
            $appointment = getAppointmentByDoctorID($id[0]);
            $bill = $appointment->Bill;
            return $bill->cost;
        }
        
    }
    //DONE
    function makeInquiry($content){
        if(isset($_POST['addInquiry']))
        {
            $inquiry = new Inquiry;
            
            $inquiry->patientID = $_SESSION['user']->ID;
            $inquiry->content = $content;

            return databaseInquiryWriter($inquiry);
        }
        
    }
    //DONE
    function viewInquiry(){
        if(isset($_POST['submitInquiry']))
        {
            $del = $_POST['checkbox'];
            for($i=0;$i < count($del);$i++){
                RemoveInquiry($del[$i]);
            }
        }
    }
    //DONE
    function removePatientInquiry($inquiryID){
        RemoveInquiry($inquiryID);
    }
    //DONE
    function uploadMyPrescription($content){
        //if(isset($_POST['addMyPres']))
        {    
            $prescription = new Prescription;
            $prescription->patientID = $_SESSION['user']->ID;
            $prescription->content = $content;
            
            databasePrescriptionWriter($prescription);
            $_SESSION['user']->Appointments = getAppointmentsByPatientID($_SESSION['user']->ID);
            $_SESSION['user']->Prescriptions = getPrescriptionsByPatientID($_SESSION['user']->ID);
        }
    }
    //DONE
    function viewPrescription(){
        if(isset($_POST['submitPrescription']))
        {    
            $index = $_POST['prescriptions'];
            $app = $this->Appointments[$index[0]];
            $pre = $app->Prescription;
            return $pre->content;
        }
    }
    //DONE
    function removePrescription($prescriptionID){
        RemovePrescription($prescriptionID);
    }
    //DONE
    function deleteAccount($patientID){
        if(isset($_POST['deleteAccount']))
        {
            databaseRemovePatient($patientID);
        }
    }
    //DONE
    function editAccount(){
        if(isset($_POST['editAccount']))
        {  
            updateUserAccount($_SESSION['user']);
        }
    }

}

?>