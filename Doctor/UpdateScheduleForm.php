<!DOCTYPE html>
<html>
<head>
    <title>Update Schedule</title>
    <title>Update My Schedule</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://localhost/ClinicProject/Doctor/test.js"></script>

    <link rel="stylesheet" href="ComponentDesign.css">
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
            $oldSchedule = $_SESSION['user']->Schedule;
            $days = array ("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

            echo "<h1>Update Schedule</h1>";
            echo "<form action='' method='post'>";
            echo "
                <table class='table table-light table-striped table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th></th>
                        <th>Day</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                ";
                for($i = 0 ; $i < count($days) ; $i++){
                    echo "
                        <tr>
                            <td><input class='checkbox'type='checkbox' id='checkbox".$i."' name='checkbox[]' value=".$i." onchange='handleCheckBox(".$i.")'></td>
                            <td>".$days[$i]."</td>
                            <td>
                                <select id='fromSelect".$i."' class='form-control' name='from[]' onchange='handleOption(".$i.")' hidden>";
                                    for($am = 8 ; $am < 10 ; $am++){
                                        echo "<option id='".$i."f0".$am."' value='".$am.":00'>".$am." AM</option>";
                                    }
                                    for($am = 10 ; $am < 12 ; $am++){
                                        echo "<option id='".$i."f".$am."' value='".$am.":00'>".$am." AM</option>";
                                    }
                                    echo "<option id='".$i."f12' value='12:00'>12 PM</option>";
                                    for($pm = 1 ; $pm < 7 ; $pm++){
                                        echo "<option id='".$i."f".($pm + 12)."' value='".($pm + 12).":00'>".$pm." PM</option>";
                                    }
                    echo "      </select>
                            </td>
                            <td>
                                <select id='toSelect".$i."' class='form-control' name='to[]' hidden>";
                                    for($am = 8 ; $am < 10 ; $am++){
                                        echo "<option id='".$i."t0".$am."' value='".$am.":00'>".$am." AM</option>";
                                    }
                                    for($am = 10 ; $am < 12 ; $am++){
                                        echo "<option id='".$i."t".$am."' value='".$am.":00'>".$am." AM</option>";
                                    }
                                    echo "<option id='".$i."t12' value='12:00'>12 PM</option>";
                                    for($pm = 1 ; $pm < 7 ; $pm++){
                                        echo "<option id='".$i."t".($pm + 12)."' value='".($pm + 12).":00'>".$pm." PM</option>";
                                    }
                    echo "      </select>
                            </td>
                        </tr>
                    ";
                }
                for($i = 0 ; $i < count($days) ; $i++){
                    if($oldSchedule->days[$i] != NULL){
                        echo"<script>
                                document.getElementById(".$i."+'f'+'".substr($oldSchedule->startTime[$i],0,2)."').selected = 'selected';
                                handleOption(".$i.");
                                document.getElementById('fromSelect".$i."').hidden = false;
                                document.getElementById('checkbox".$i."').checked = 'true';
                                document.getElementById(".$i."+'t'+'".substr($oldSchedule->endTime[$i],0,2)."').selected = 'selected';
                                document.getElementById('toSelect".$i."').hidden = false;
                            </script>";
                    }
                }
            echo "</tbody>";
            echo "</table>";
            echo "<input type='submit' value='Save' name='updatedSchedule'>";
            echo "</form>";
            
            if(isset($_POST['updatedSchedule'])){
                $_SESSION['user']->updateSchedule();
                echo '<script>javascript:history.go(-2)</script>';
            }
        ?>
    </div>
</body>
</html>