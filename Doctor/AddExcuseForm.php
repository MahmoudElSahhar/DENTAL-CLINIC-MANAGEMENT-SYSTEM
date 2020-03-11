<!DOCTYPE html>
<html>
<head>
    <title>Make Excuse</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="http://localhost/ClinicProject/Doctor/ExcuseFromToValidation.js"></script>

    <link rel="stylesheet" href="ComponentDesign.css">
    <link rel="stylesheet" href="MyCSS.css">

    <style>
        input[type="submit"] {
            width: 20%;
            margin-left: 5%;
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
    </style>
</head>
<body>
    <?php
        include 'sideNav.php';
    ?>
    <div class='background'>
    <?php
        include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
        ob_start();
        session_start();
        echo "<h1>Add Excuse</h1>";

        $arrOfDays = array("Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday" , "Saturday");

        echo "
            <form action='' method='post' name='test'>
            Date : <input id='chooseDate' class='form-control col-sm-3' type='date' name='date' onchange='this.form.submit()'><br><br>
            Start Time : 
                <select id='fromSelect' class='form-control col-sm-2' name='from' disabled>";
                
                    for($i = 8 ; $i <= 9 ; $i++){
                        echo "<option id='f0".$i."' value='".$i."'>".$i." AM</option>";
                    }
                    for($i = 10 ; $i <= 11 ; $i++){
                        echo "<option id='f".$i."' value='".$i."'>".$i." AM</option>";
                    }
                    echo "<option id='f12' value='12'>12 PM</option>";
                    for($j = 1 ; $j <= 6 ; $j++){
                        echo "<option id='f".($j + 12)."' value='".($j + 12)."'>".$j." PM</option>";
                    }
               
        echo "  </select>
                <br><br>
            End Time : 
                <select id='toSelect' class='form-control col-sm-2' name='to' disabled>";
                
                    for($i = 8 ; $i <= 9 ; $i++){
                        echo "<option id='t0".$i."' value='".$i."'>".$i." AM</option>";
                    }
                    for($i = 10 ; $i <= 11 ; $i++){
                        echo "<option id='t".$i."' value='".$i."'>".$i." AM</option>";
                    }
                    echo "<option id='t12' value='12'>12 PM</option>";
                    for($j = 1 ; $j <= 6 ; $j++){
                        echo "<option id='t".($j + 12)."' value='".($j + 12)."'>".$j." PM</option>";
                    }
                
        echo "  </select>
                <br><br>
            <input type='submit' name='addExcuse' value='OK'>
        </form>
        ";

        if(isset($_POST['date'])){
            
            $date = $_POST['date'];
            echo "
                <script>
                    document.getElementById('chooseDate').value = '".$date."';
                </script>
            ";
            $day = date('l', strtotime($date));
            $dayIndex = array_search($day , $arrOfDays);
            if($_SESSION['user']->Schedule->days[$dayIndex] != NULL){
                echo "
                    <script>
                        from = document.getElementById('fromSelect');
                        to = document.getElementById('toSelect');

                        from.disabled = false;
                        to.disabled = false;

                        var start = parseInt(".substr($_SESSION['user']->Schedule->startTime[$dayIndex],0,2).");
                        var end = parseInt(".substr($_SESSION['user']->Schedule->endTime[$dayIndex],0,2).");

                        document.getElementById('f08').disabled = 'disabled';
                        document.getElementById('t18').disabled = 'disabled';

                        //alert(start);
                        //alert(end);

                        from.setAttribute('onchange', 'updateTo(from.id , start , end)');

                        document.getElementById('f'+start).selected = 'selected';
                        document.getElementById('t'+end).selected = 'selected';

                        for(var i = 8 ; i < start ; i++){
                            if(i == 8 || i == 9){
                                document.getElementById('f0'+i).disabled = 'disabled';
                                document.getElementById('t0'+i).disabled = 'disabled';
                            }
                            else{
                                document.getElementById('f'+i).disabled = 'disabled';
                                document.getElementById('t'+i).disabled = 'disabled';
                            }
                        }
                        for(var j = (end+1) ; j <= 18 ; j++){
                            if(j == 8 || j == 9){
                                document.getElementById('f0'+j).disabled = 'disabled';
                                document.getElementById('t0'+j).disabled = 'disabled';
                            }
                            else{
                                document.getElementById('f'+j).disabled = 'disabled';
                                document.getElementById('t'+j).disabled = 'disabled';
                            }
                        }
                    </script>
                ";
            }
            
            if(isset($_POST['addExcuse'])){
                $_SESSION['user']->addExcuse();
                header("Location: ViewExcuseForm.php");
            }
        }
    ?>
    </div>
</body>
</html>