<?php

class Appointment{
    public $ID;             //int
    public $date;           //string
    public $type = '';      //string
    public $startTime = ''; //string
    public $endTime = '';   //string
    public $patientID;      //int
    public $doctorID;       //int
    public $confirmed;      //boolean
    public $Prescription;   //object
    public $Bill;            //object
	
}

?>