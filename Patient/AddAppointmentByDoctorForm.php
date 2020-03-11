<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Analysis Form</title>
    <link rel="stylesheet" href="ComponentDesign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        button {
            border-radius: 25px;
        }
    </style>
</head>
<body>

<?php include 'sideNav.php'; ?>

    <?php
        include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Prescription.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        session_start();
        $doctorID;
        $doctorsNames = getDoctorNames();
        echo "<div class='container'>";
        echo "
            <form action='' method='post'>
            <h1>Add an appointment</h1><br>
            <h3>Choose a doctor:</h3>
            <select name='DoctorID' class='form-control'>";
            for($i = 0 ; $i < count($doctorsNames) ; $i++){
                echo "<option value='".$doctorsNames[$i]->ID."'>".$doctorsNames[$i]->fullName."</option>";
            }
            echo "</select> <br>
            <input type='submit' id='addBtn' value='Search' name='searchDoctor'>
            </form>
        ";

        if(isset($_POST['searchDoctor']))
        {
           
            $arrOfDays = array("Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday" , "Saturday");
            $arrOfDates = array();
            $startTime = new DateTime('07:30:00');
            
            echo "<form action='' method='post'>";
            ///////
            echo "<table>
            <tr><td><button type='submit' class='w3-btn w3-teal' name='decrement' id='decrement'><i class='glyphicon glyphicon-arrow-left'></i></button></td>";
            //////
            echo "<td><input type='hidden' name='docs' value='".$_POST['DoctorID']."'>";
            echo "<table id='tblData' class='table table-light table-striped table-hover'>";
            echo "<thead class='thead-dark'><tr>";
            echo "<th></th>";

            //$_SESSION['date'] = date("Y-m-d");
            
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
            </td>
            <td>
                <button type='submit' class='w3-btn w3-teal' name='increment' id='increment'><i class='glyphicon glyphicon-arrow-right'></i></button>
            </td></tr></table>
            </form>";

            

            //echo "<form action='' method='post'>";

            $doctorID = $_POST['DoctorID'];
            $s = readSchedule($_POST['DoctorID'] , $_SESSION['date']);
            $e = readExcuseForPatient($_POST['DoctorID']);
            $appoints = readAppointmentsByDoctorID($_POST['DoctorID']);

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
        if(isset($_POST['saveAppo']))
        {
            //session_start();
            $appointment = new Appointment;
            $appointment->date = substr($_POST['appointmentTime'],0,10);
            $appointment->type = "check";
            $appStartTime = new DateTime(substr($_POST['appointmentTime'],11,8));
            //$appEndTime = $appStartTime->add(new DateInterval('PT30M'));
            $appointment->startTime = $appStartTime->format('H:i:s');
            $appStartTime->add(new DateInterval('PT30M'));
            $appointment->endTime = $appStartTime->format('H:i:s');
            $appointment->patientID = $_SESSION['user']->ID;
            $appointment->doctorID = $_POST['docs'];
            $_SESSION['user']->reserveAppointment($appointment);

            //$docName = getDoctor($appointment->doctorID);
            /*//Send a mail to patient
            $to = $_SESSION['user']->email;
            $subject = "Appointment Confirmation";
            $txt = "Dear ".$_SESSION['user']->fullName.", \n This is a confirmation email for your appointment at ".$appointment->startTime.
                " on ".$appointment->date." with Dr. ".$docName->fullName." \n Looking forward to see you.";
            $headers = "From: clinic@gmail.com" . "\r";
            mail($to,$subject,$txt,$headers);
            //////////////////////////////////////*/
            echo '<script>javascript:history.go(-3)</script>';
        }
        if(isset($_POST['increment']))
        {
            $_SESSION['date'] = date('Y-m-d', strtotime('+7 day', strtotime($_SESSION['date'])));
            echo '<script>javascript:history.go(-2)</script>';
        }
        if(isset($_POST['decrement']) && $_SESSION['date'] != date("Y-m-d"))
        {
            $_SESSION['date'] = date('Y-m-d', strtotime('-7 day', strtotime($_SESSION['date'])));
            echo '<script>javascript:history.go(-2)</script>';
        }

?>
    
        </div>
</body>
</html>