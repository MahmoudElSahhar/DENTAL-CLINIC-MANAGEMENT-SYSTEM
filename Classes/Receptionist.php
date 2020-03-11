<?php

class Receptionist extends User{

    function addDoctor(){
        echo "yes";
        $doctor = new Doctor;
        $doctor->fullName = $_POST['fullname'];
        $doctor->dob = $_POST['dob'];
        $doctor->email = $_POST['email'];
        $doctor->telephone = $_POST['telephone'];
        $doctor->username = $_POST['username'];
        $doctor->password = $_POST['password'];
                        
        $doctorID = writeDoctor($doctor);
                
        $schedule = new Schedule;
        $schedule->days = array_fill(0, 7, NULL);
        $schedule->startTime = array_fill(0, 7, NULL);
        $schedule->endTime = array_fill(0, 7, NULL);
        $schedule->days = $_POST['checkbox'];
        $schedule->startTime = $_POST['from'];
        $schedule->endTime = $_POST['to'];
                
        writeDoctorAvailability($doctorID , $schedule , NULL);
    }
                            
    function respondToInquiries($inquiryID,$inquirycontent){}
                            
    function reserveAppointment($appointment){
        writeAppointment($appointment);
    }
    
    function checkDoctorExcuses($date , $startTime , $endTime){
        return (checkExcuses($date , $startTime , $endTime));
    }

    function deleteAppointment($appointmentID){
        RemoveAppointment($appointmentID);
    }

    function confirmAppointment($appointmentID){
        updateAppointmentToConfirm($appointmentID);
    }

    function confirmDoctorSchedule($doctorID){
    }

    function updateDoctorAccount($doctor){
        updateUserAccount($doctor);
    }

    function removeDoctorAccount($doctorID){
        deleteDoctorAccount($doctorID);
    }
    ////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////
    function issueBill($cost, $appointmentID){
		writeBill($cost, $appointmentID);
	}
}
?>
