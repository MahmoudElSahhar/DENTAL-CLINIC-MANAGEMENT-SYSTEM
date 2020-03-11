<!DOCTYPE html>
<html>
<head>
    <title>View My Schedule</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="MyCSS.css">

    <style>
        input[type="submit"] {
            width: 20%;
            margin-left: 75%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: Teal;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
        }
        input[type="submit"]:hover {
            background-color: #f2f2f2;
            color: Teal;
            font-style: bold;
            font-size: 20px;
            border: 1px solid Teal;
        }
        .background{
            height: 100%;
            width: 85%;
            margin-left: 15%;
            position: fixed;
            padding-left: 5%;
            padding-top: 3%;
            background-color: rgb(160, 193, 255);
        }
        .table{
            width: 90%;
            height: 90%;
        }
    </style>
    
</head>
<body>
    <?php
        include 'sideNav.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
    ?>

    <div class='background'>
    <?php
        ob_start();
        session_start();
        $s = $_SESSION['user']->Schedule;
        echo "<h1>My Schedule</h1>";

        if($s != NULL){
            $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            //echo "<div class='container'>";
            echo "<table class='table table-light table-striped table-hover'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th></th>";
            for($day = 0 ; $day < count($days) ; $day++){
                echo "<th>".$days[$day]."</th>";
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            for($t = 8 ; $t <= 18 ; $t++){
                echo "<tr>";
                if($t <= 11){
                    echo "<th>".$t.":00 AM</th>";
                }
                else if($t == 12){
                    echo "<th>".$t.":00 PM</th>";
                }
                else{
                    echo "<th>".($t - 12).":00 PM</th>";
                }
                for($d = 0 ; $d < 7 ; $d++){
                    echo "<td id='".$t.'/'.$d."'> </td>";       //data ".$t.'/'.$d."
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            //echo "</div>";
    
            for($d = 0 ; $d < 7 ; $d++){
                if($s->days[$d] != NULL){
                    echo "
                        <script>
                            var s = parseInt(".substr($s->startTime[$d],0,2).");
                            var e = parseInt(".substr($s->endTime[$d],0,2).");
                            for(s ; s <= e ; s++){
                                document.getElementById(s + '/".$d."').innerHTML = 'Available';
                            }
                        </script>
                    ";
                }
            }
        }
        echo "
            <form action='' method='post'>
                <input type='submit' name='updateSchedule' value='Update Schedule'>
            </form>
        ";
        if(isset($_POST['updateSchedule'])){
            header("Location: UpdateScheduleForm.php");
        }
    ?>
    </div>
</body>
</html>