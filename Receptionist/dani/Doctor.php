<?php

class Doctor{
   
    public $ID;                         //int
    public $fullName = '';              //string                                   
    public $age;                        //int
    public $telephone;                  //string
    public $username = '';              //string
    public $password = '';              //string
    public $email=''  ;                 //string
    public $userType='';                //int
    public $appointments = array();     //array of int
    public $startTime = array();         //array of string
    public $endTime = array();         //array of string


    function updateSchedule(){

    }

    function makeExcuse(){

    }

    function addPrescription($appointmentID){

    }

    function viewPrescription($appointmentID){

    }

    function viewAppointmentSchedule(){

    }

}

?>