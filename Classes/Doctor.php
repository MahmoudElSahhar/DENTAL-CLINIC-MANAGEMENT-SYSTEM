<?php
require 'User.php';
require 'Schedule.php';

class Doctor extends User{
    public $Appointments;     //array of Appointments
    public $Schedule;         //Object of Schedule
    public $Excuses;          //array of Excuses

    ////////////////////////////////////////////Account
    function updateAccount(){
        session_start();
        $_SESSION['user']->fullName = $_POST['fullname'];
        $_SESSION['user']->dob = $_POST['dob'];
        $_SESSION['user']->telephone = $_POST['telephone'];
        $_SESSION['user']->email = $_POST['email'];
        $_SESSION['user']->username = $_POST['username'];
        $_SESSION['user']->password = $_POST['password'];

        updateUserAccount($_SESSION['user']);
    }

    function deleteAccount(){
        removeDoctorAccount($_SESSION['user']->ID);
        $_SESSION['user'] = NULL;
    }

    ////////////////////////////////////////////DoctorShedule
    /*function addSchedule(){
        if(isset($_POST['addDoctor'])){
            $schedule = new Schedule;
            $schedule->days = array_fill(0, 7, NULL);
            $schedule->startTime = array_fill(0, 7, NULL);
            $schedule->endTime = array_fill(0, 7, NULL);
            $schedule->days = $_POST['checkbox'];
            $schedule->startTime = $_POST['from'];
            $schedule->endTime = $_POST['to'];

            session_start();
            echo($_SESSION['user']->ID);
            writeDoctorAvailability($_SESSION['user']->ID , $schedule);
            
        }
    }*/

    /*function viewSchedule(){
        if(isset($_POST['viewSchedule'])){
            $s = readSchedule($_POST['id']);
            return $s;
        }
    }*/

    function updateSchedule(){
        if(isset($_POST['updatedSchedule'])){
            $newSchedule = new Schedule;
            $newSchedule->days = $_POST['checkbox'];
            $newSchedule->startTime = $_POST['from'];
            $newSchedule->endTime = $_POST['to'];

            updateDoctorAvailability($_SESSION['user']->ID , $newSchedule);
            $_SESSION['user']->Schedule = readSchedule($_SESSION['user']->ID , date('Y-m-d'));
        }
    }

    ////////////////////////////////////////////DoctorExcuse
    function addExcuse(){
        if(isset($_POST['addExcuse'])){
            $excuse = new Excuse;
            $excuse->doctorID = $_SESSION['user']->ID;
            $excuse->date = $_POST['date'];
            $excuse->startTime = $_POST['from'];
            $excuse->endTime = $_POST['to'];
            
            writeDoctorExcuse($excuse);
        }
    }

    function deleteExcuse($i , $excuseID){
        databaseRemoveExcuse($excuseID);
        array_splice($_SESSION['user']->Excuses , $i , 1);
    }

    function viewExcuse(){
        if(isset($_POST['viewExcuse'])){
            $e = readExcuse($_POST['id']);
            return $e;
        }
    }

    function updateExcuse(){
        if(isset($_POST['updateExcuse'])){
            $e = new Excuse;
            $e->ID = $_SESSION['user']->Excuses[$_SESSION['excuseIndex']]->ID;
            //echo($e->ID);
            $e->doctorID = $_SESSION['user']->ID;
            $e->date = $_POST['date'];
            $e->startTime = $_POST['from'];
            $e->endTime = $_POST['to'];
            updateExcuse($e);
            $_SESSION['user']->Excuses[$_SESSION['excuseIndex']] = $e;
        }
    }

    ////////////////////////////////////////////Prescription
    function addPrescription($appointmentID){
            $p = new Prescription;
            $p->content = $_FILES['presFile']['name'];

            writePrescription($appointmentID , $p);
    }

    function deletePrescription($appointmentID){
        removePrescriptionByAppointmentID($appointmentID);
        $_SESSION['user']->Appointments = readAppointmentsByDoctorID($_SESSION['user']->ID);
    }

    /*function viewPrescription(){
        if(isset($_POST['viewPrescription'])){
            $p = readPrescription($_POST['appID']);
            if($p != NULL){
                return $p;
            }
        }
    }*/

    function updatePrescription($pres){
        if(isset($_POST['updatePrescription'])){
            databaseUpdatePrescription($pres);
            $_SESSION['user']->Appointments = readAppointmentsByDoctorID($_SESSION['user']->ID);
        }
    }

    ////////////////////////////////////////////DoctorAppointment
    function viewAppointmentSchedule(){}

}

?>