<!DOCTYPE html>
<html>
<head>
    <title>Update My Excuse</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://localhost/ClinicProject/Doctor/ExcuseFromToValidation.js"></script>

    <link rel="stylesheet" href="MyCSS.css">
</head>
<body>
    <?php include 'sideNav.php'; ?>

    <div class='background'>
    <?php
        include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
    ?>

    <?php
        session_start();
        $e = $_SESSION['user']->Excuses[$_SESSION['excuseIndex']];
        echo "<h1>Update Excuse</h1>";
        echo "
            <form action='' method='post'>
            Date <input class='form-control col-sm-3' type='date' name='date' value='".$e->date."'><br>";
            echo "<b> from </b>
            <select class='form-control col-sm-2' name='from'>";
                for($am = 8 ; $am < 10 ; $am++){
                    echo "<option id='f0".$am."' value='".$am.":00'>".$am." AM</option>";
                }
                for($am = 10 ; $am < 12 ; $am++){
                    echo "<option id='f".$am."' value='".$am.":00'>".$am." AM</option>";
                }
                echo "<option id='f12' value='12:00'>12 PM</option>";
                for($pm = 1 ; $pm < 7 ; $pm++){
                    echo "<option id='f".($pm + 12)."' value='".($pm + 12).":00'>".$pm." PM</option>";
                }

            echo "</select>
            <b> to </b>
            <select class='form-control col-sm-2' name='to'>";
                for($am = 8 ; $am < 10 ; $am++){
                    echo "<option id='t0".$am."' value='".$am.":00'>".$am." AM</option>";
                }
                for($am = 10 ; $am < 12 ; $am++){
                    echo "<option id='t".$am."' value='".$am.":00'>".$am." AM</option>";
                }
                echo "<option id='t12' value='12:00'>12 PM</option>";
                for($pm = 1 ; $pm < 7 ; $pm++){
                    echo "<option id='t".($pm + 12)."' value='".($pm + 12).":00'>".$pm." PM</option>";
                }
                echo "</select>";
            echo "<br>";
            echo "<br>";

            echo"<script>
                    document.getElementById('f'+'".substr($e->startTime,0,2)."').selected = 'selected';
                    document.getElementById('t'+'".substr($e->endTime,0,2)."').selected = 'selected';
                </script>";

            echo "<input type='submit' name='updateExcuse' value='Save'>";
            echo "</form>";

            if(isset($_POST['updateExcuse'])){
                $_SESSION['user']->updateExcuse();
                echo '<script>javascript:history.go(-2)</script>';
            }
            
    ?>
    </div>
</body>
</html>