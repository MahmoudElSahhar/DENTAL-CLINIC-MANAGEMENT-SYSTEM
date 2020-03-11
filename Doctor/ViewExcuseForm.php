<!DOCTYPE html>
<html>
<head>
    <title>View My Excuses</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="MyCSS.css">
    <style>
        input[type="submit"] {
            width: 70%;
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
        .table{
            width: 90%;
            height: 90%;
        }
    </style>
</head>
<body>
    <?php
        include 'sideNav.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Excuse.php';
        include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
    ?>

    <div class='background'>
    <?php
        ob_start();
        session_start();
        $excuses = $_SESSION['user']->Excuses;
        echo "<h1>My Excuses</h1>";
        if($_SESSION['user']->Excuses != NULL){

            echo "<form action='' method='post'>";
            echo "
                <table class='table table-light table-striped table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Date</th>
                            <th>StartTime</th>
                            <th>EndTime</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
            ";
            for($i = 0 ; $i < count($excuses) ; $i++){
                echo "
                    <tr>
                        <td>".$excuses[$i]->date."</td>
                        <td>".$excuses[$i]->startTime."</td>
                        <td>".$excuses[$i]->endTime."</td>
                        <td><input type='submit' value='Edit' name='e".$excuses[$i]->ID."'></td>
                        <td><input type='submit' value='Delete' name='d".$excuses[$i]->ID."'></td>
                    </tr>
                ";
            }
            echo "</table>";
        }
            echo "</form>";
            echo "
                <form action='' method='post'>
                    <input type='submit' name='addExcuse' value='Add Excuse'>
                </form>
                ";
                if(isset($_POST['addExcuse'])){
                    header("Location: AddExcuseForm.php");
                }
        

        for($i = 0 ; $i < count($excuses) ; $i++){
            if(isset($_POST['d'.$excuses[$i]->ID])){
                $_SESSION['user']->deleteExcuse($i , $excuses[$i]->ID);
                echo '<script>javascript:history.go(-1)</script>';
            }
            else if(isset($_POST['e'.$excuses[$i]->ID])){
                $_SESSION['excuseIndex'] = $i;
                header("Location: UpdateExcuseForm.php");
            }
        }
        
    ?>
    </div>
</body>
</html>