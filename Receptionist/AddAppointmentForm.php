<!DOCTYPE html>
<html>
<head>
    <title>Add Appoinment</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://localhost/ClinicProject/Receptionist/test.js"></script>

    <link rel="stylesheet" href="MyCSS.css">
    
</head>
<body>
    <?php include 'sideNav.php'; ?>
    <div class='background'>
        <?php
            include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Appointment.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Bill.php';
            include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
            session_start();

            $doctorID;
            $patientID;
            $visitDuration;
            $doctorsNames = getDoctorNames();
            $patientNames = getPatientNames();
            echo "
                <form action='' method='post'>
                    <h1>Add an appointment</h1><br>
                    <h3>Choose a doctor:</h3>
                    <select name='DoctorID' class='form-control col-sm-3'>";
                    for($i = 0 ; $i < count($doctorsNames) ; $i++){
                        echo "<option value='".$doctorsNames[$i]->ID."'>".$doctorsNames[$i]->ID." - ".$doctorsNames[$i]->fullName."</option>";
                    }
                    echo "</select> <br>
                    <h3>Choose a patient:</h3>
                    <select name='PatientID' class='form-control col-sm-3'>";
                    for($i = 0 ; $i < count($patientNames) ; $i++){
                        echo "<option value='".$patientNames[$i]->ID."'>".$patientNames[$i]->ID." - ".$patientNames[$i]->fullName."</option>";
                    }
                    echo "</select> <br>
                    <h3>Select Visit Duration:</h3>
                    <select name='visitDuration' class='form-control col-sm-3'>
                        <option value='30'>30 mins Visit</option>
                        <option value='60'>1 hour Visit</option>
                        <option value='90'>1.5 hour Visit</option>
                        <option value='120'>2 hour Visit</option>
                    </select> <br>
                    <input type='submit' id='addBtn' value='Search' name='searchDoctor'>
                </form>
                ";
            
            if(isset($_POST['searchDoctor'])){
                $doctorID = $_POST['DoctorID'];
                $patientID = $_POST['PatientID'];
                $visitDuration = $_POST['visitDuration'];
                $arrOfDays = array("Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday" , "Saturday");
                $arrOfDates = array();
                $startTime = new DateTime('07:30:00');
                $endTime = new DateTime('08:00:00');
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='DoctorID' value='".$_POST['DoctorID']."'>";
                echo "<input type='hidden' name='PatientID' value='".$_POST['PatientID']."'>";
                echo "<input type='hidden' name='visitDuration' value='".$_POST['visitDuration']."'>";
                //echo "<button type='submit' class='w3-btn w3-teal' name='decrement' id='decrement'><i class='glyphicon glyphicon-arrow-left'></i></button>";
                //echo "<button type='submit' class='w3-btn w3-teal' name='increment' id='increment'><i class='glyphicon glyphicon-arrow-right'></i></button>";
                echo "<table id='tableData' class='table table-light table-striped table-hover'>";
                echo "<thead class='thead-dark'><tr>";
                echo "<th></th>";
                for($head = 0; $head < 7 ; $head++)
                {
                    $date = strtotime("+".$head." day", strtotime(date("Y-m-d")));
                    echo "
                        <th>".date('l', $date). "<br>". date("Y-m-d", $date) ."</th>
                    ";
                    $arrOfDates[$head] = date("Y-m-d", $date);
                }
                echo "</tr></thead>";
                for($t = 0 ; $t < 20 ; $t++){
                    echo "<tr>";
                    $startTime->add(new DateInterval('PT30M'));
                    $endTime->add(new DateInterval('PT30M'));
                    echo "<th>".$startTime->format('h:i A')." - ".$endTime->format('h:i A')."</th>";
                    for($d = 0 ; $d < 7 ; $d++){
                        echo "<td id='".$arrOfDates[$d]."/".$startTime->format('H:i:s')."'></td>";
                    }
                    echo "</tr>";
                }
                //echo "</div>";
                echo "</table>
                <input type='submit' id='addBtn' value='Save Appointment' name='saveAppo'>
                </form>";

                //echo "<form action='' method='post'>";

                //$doctorID = $_POST['DoctorID'];
                //$visitDuration = $_POST['visitDuration'];
                $s = readSchedule($doctorID , $_SESSION['date']);
                $e = readExcuseForPatient($doctorID);
                $appoints = readAppointmentsByDoctorID($doctorID);

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
                                    element.setAttribute('type', 'checkbox');
                                    element.setAttribute('id', '".$arrOfDates[$i]."_".$st->format('H:i:s')."');
                                    var id = '".$arrOfDates[$i]."_".$st->format('H:i:s')."';
                                    var dur = '".$visitDuration."';
                                    element.setAttribute('value', '".$arrOfDates[$i]."_".$st->format('H:i:s')."');
                                    element.setAttribute('name', 'appointmentTime');
                                    element.setAttribute('onclick', 'handleRadioButton(id , dur)');
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
                    if($appoints[$w]->date != NULL)
                    {                    
                        $ast = new DateTime($appoints[$w]->startTime);
                        $aet = new DateTime($appoints[$w]->endTime);
                        
                        for($ast ; $ast < $aet ; $ast = $ast->add(new DateInterval('PT30M')))
                        {
                            echo "<script> document.getElementById('".$appoints[$w]->date."/".$ast->format('H:i:s')."').innerHTML = 'Taken';</script>";
                        }
                    }
                }

            }
            if(isset($_POST['saveAppo'])){
                $appointment = new Appointment;
                $appointment->date = substr($_POST['appointmentTimeTaken'],0,10);
                $appointment->type = "check";

                $appStartTime = new DateTime(substr($_POST['appointmentTimeTaken'],11,8));
                $appointment->startTime = $appStartTime->format('H:i:s');

                $appEndTime = $appStartTime->add(new DateInterval('PT'.$_POST['visitDuration'].'M'));
                $appointment->endTime = $appEndTime->format('H:i:s');

                $appointment->patientID = $_POST['PatientID'];
                $appointment->doctorID = $_POST['DoctorID'];

                $_SESSION['user']->reserveAppointment($appointment);
                echo '<script>javascript:history.go(-2)</script>';
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