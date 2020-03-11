<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Patient Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">

</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php'; ?>
    <?php session_start(); ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    
    <?php include 'sideNav.php'; ?>

    <form name="PatientAppointmentsForm" action="" method="post">

    <br><br>        
  <div class="container">
  <h1>My Appointments</h1> <br>

    <h3>Add an appointment</h3>
    
    <hr>
    <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Doctor</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Confirmed</th>
            <th>Edit</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>
        
        


    <?php
        //session_start();
        $_SESSION['date'] = date("Y-m-d");

        $_SESSION['user']->Appointments = getAppointmentsByPatientID($_SESSION['user']->ID);
        $appointments = $_SESSION['user']->Appointments;
        $con = array("No", "Yes");
        
        for($i=0;$i<sizeof($appointments);$i++)
        {
            $doctor = getDoctor($appointments[$i]->doctorID , $_SESSION['date']);
            echo "<tr>
                    <td>".$doctor->fullName."</td>
                    <td>".$appointments[$i]->type."</td>
                    <td>".$appointments[$i]->date."</td>
                    <td>".$appointments[$i]->startTime."</td>
                    <td>".$con[$appointments[$i]->confirmed]."</td>
                    <td><input id='edit' type='submit' name='e".$appointments[$i]->ID."' value='Edit'</td>
                    <td><input id='cancel' type='submit' name='c".$appointments[$i]->ID."' value='Cancel'</td>
                </tr>";
        }
        echo "</tbody></table>";
        echo "<button type='button' id='addBtn' class='w3-btn w3-teal' onclick=window.location.href='AddAppointmentByDoctorForm.php'>Add Appointment</button>";
        
        //echo "</div>";

        for($i=0;$i<sizeof($appointments);$i++)
        {
            if(isset($_POST['c'.$appointments[$i]->ID]))
            {
                $_SESSION['user']->cancelAppointment($appointments[$i]->ID);
            }
        }

        for($i=0;$i<sizeof($appointments);$i++)
        {
            if(isset($_POST['e'.$appointments[$i]->ID]))
            {
                echo "<input type='hidden' name='appID' value='".$appointments[$i]->ID."'>";
                echo "<table id='tblData' class='table table-light table-striped table-hover'>";
                echo "<thead class='thead-dark'><tr>";
                echo "<th></th>";

                //$_SESSION['date'] = date("Y-m-d");
                $arrOfDates = array();
                $arrOfDays = array("Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday" , "Saturday");
                $startTime = new DateTime('07:30:00');
                
                for($head = 0; $head < 7 ; $head++)
                {
                    $date = strtotime("+".$head." day", strtotime($_SESSION['date']));
                    echo "
                        <th>".date('l', $date). "<br>". date("Y-m-d", $date) ."</th>
                    ";
                    $arrOfDates[$head] = date("Y-m-d", $date);
                }
                echo "</tr></thead>";
                for($t = 0 ; $t < 20 ; $t++){
                    echo "<tr>";
                    $startTime->add(new DateInterval('PT30M'));
                    echo "<td>".$startTime->format('h:i A')."</td>";
                    for($d = 0 ; $d < 7 ; $d++){
                        echo "<td id='".$arrOfDates[$d]."/".$startTime->format('H:i:s')."'></td>";
                    }
                    echo "</tr>";
                }
                //echo "</div>";
                echo "</table>
                <input type='submit' id='addBtn' value='Save Appointment' name='saveAppo'> <br>
                </form>";

                ////////////////////////////////////////////////////////////////////////

                $doctorID = $doctor->ID;
                $s = readSchedule($doctor->ID, $_SESSION['date']);
                $e = readExcuseForPatient($doctor->ID);
                $appoints = readAppointmentsByDoctorID($doctor->ID);

                //apply the doctor schedule on the table
                for($i = 0 ; $i < count($arrOfDates) ; $i++){
                    $date = strtotime("+0 day", strtotime($arrOfDates[$i]));
                    $dayIndex = array_search(date('l', $date) , $arrOfDays);
                    
                    if($s->days[$dayIndex] != NULL){
                        
                        $st = new DateTime($s->startTime[$dayIndex]);
                        $et = new DateTime($s->endTime[$dayIndex]);

                        for($st ; $st < $et ; $st = $st->add(new DateInterval('PT30M')))
                        {
                            echo "<script>
                                    var element = document.createElement('input');
                                    element.setAttribute('type', 'radio');
                                    element.setAttribute('value', '".$arrOfDates[$i]."_".$st->format('H:i:s')."');
                                    element.setAttribute('name', 'appointmentTime');
                                    var d = document.getElementById('".$arrOfDates[$i]."/".$st->format('H:i:s')."');
                                    d.appendChild(element);
                                </script>";
                        }

                    }
                    echo "<br>";
                }
                //apply doctor excuses on the table
                for($q = 0; $q < sizeof($e) ; $q++)
                {
                    if($e[$q]->date != NULL)
                    {                    
                        $sTime = new DateTime($e[$q]->startTime);
                        $eTime = new DateTime($e[$q]->endTime);
                        
                        for($sTime ; $sTime < $eTime ; $sTime = $sTime->add(new DateInterval('PT30M')))
                        {
                            echo "<script> document.getElementById('".$e[$q]->date."/".$sTime->format('H:i:s')."').innerHTML = 'EXCUSE';</script>";
                        }
                    }
                    
                }
                //apply taken appointments on the table
                for($w = 0 ; $w < sizeof($appoints) ; $w++)
                {
                    $ast = new DateTime($appoints[$w]->startTime);
                    echo "<script> document.getElementById('".$appoints[$w]->date."/".$ast->format('H:i:s')."').innerHTML = 'Taken';</script>";
                }

            }
        }


        if(isset($_POST['saveAppo']))
        {
            //session_start();
            $appointment = new Appointment;
            $appointment->ID = $_POST['appID'];
            $appointment->date = substr($_POST['appointmentTime'],0,10);
            $appointment->type = "check";
            $appStartTime = new DateTime(substr($_POST['appointmentTime'],11,8));
            //$appEndTime = $appStartTime->add(new DateInterval('PT30M'));
            $appointment->startTime = $appStartTime->format('H:i:s');
            $appStartTime->add(new DateInterval('PT30M'));
            $appointment->endTime = $appStartTime->format('H:i:s');
            $appointment->patientID = $_SESSION['user']->ID;
            $appointment->doctorID = $doctor->ID;
            $_SESSION['user']->updateAppointment($appointment);

            /*$docName = getDoctor($appointment->doctorID);
            //Send a mail to patient
            $to = $_SESSION['user']->email;
            $subject = "Appointment Confirmation";
            $txt = "Dear ".$_SESSION['user']->fullName.", \n This is a confirmation email for your updated appointment at ".$appointment->startTime.
                " on ".$appointment->date." with Dr. ".$docName->fullName." \n Looking forward to see you.";
            $headers = "From: clinic@gmail.com" . "\r";
            mail($to,$subject,$txt,$headers);*/
            //////////////////////////////////////
            echo '<script>javascript:history.go(-2)</script>';
        }
        
    ?>

    </div>
    </form>

</body>
</html>