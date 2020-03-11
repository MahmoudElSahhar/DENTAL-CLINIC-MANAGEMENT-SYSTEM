<?php

class Patient{
    public $ID;                         //int
    public $fullName = '';              //string
    public $age;                        //int
    public $telephone;                  //string
    public $username = '';              //string
    public $password = '';              //string
    public $appointments = array();     //array of int
    public $analysis = array();         //array of int


    function viewDoctorSchedule($doctorID){
        
    }

    function reserveAppointment($doctorID){

    }

    function cancelAppointment($appointmentID){

    }

    function updateAppointment($appointmentID){

    }

    function viewPrescription($appointmentID){

    }

    function uploadAnalysis(){

    }

    function viewBill($appointmentID){

    }

    function makeInquiry(){

    }

}

?>