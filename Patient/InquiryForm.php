<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Inquiry Form</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ComponentDesign.css">
    <style>
        
        .container {
            padding-left: 170px;
            width: 100%;
        }
        #myBtn {
            margin-left: 20%;
            width: 50%;
        }

    </style>
</head>
<body>

    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\User.php'; ?>
    <?php require 'C:\xampp\htdocs\ClinicProject\Classes\Inquiry.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>
    <?php include 'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
    <?php session_start(); ?>
    
    <?php include 'sideNav.php'; ?>

        <div class="container">

        <form name="patientForm" action="" method="post">

        <br><br>

        <h1>My Inquiries</h1>    <br>
        <table class="table table-light table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Patient Name</th>
            <th>Inquiry</th>
            <th>Answer</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>


        <?php
        //session_start();
        $inquiry = getInquiryByPatientID($_SESSION['user']->ID);

        for($i=0;$i<sizeof($inquiry);$i++)
        {
            if($inquiry[$i]->answered == 1){
                echo "<tr>
                        <td>".$_SESSION['user']->fullName."</td>
                        <td>".$inquiry[$i]->content."</td>
                        <td>".$inquiry[$i]->respond."</td>
                        <td><input type='submit' name='".$inquiry[$i]->ID."' value ='Cancel'></td>
                        
                    </tr>";
            }
            else if($inquiry[$i]->answered == 0){
                echo "<tr>
                        <td>".$_SESSION['user']->fullName."</td>
                        <td>".$inquiry[$i]->content."</td>
                        <td>Not answered yet</td>
                        <td><input type='submit' name='".$inquiry[$i]->ID."' value ='Cancel'></td>
                        
                    </tr>";
            }
        }
        echo "</tbody></table><br>";

        for($i=0;$i<sizeof($inquiry);$i++)
        {
            if(isset($_POST[''.$inquiry[$i]->ID]))
            {
                $_SESSION['user']->removePatientInquiry($inquiry[$i]->ID);
                echo '<script>javascript:history.go(-1)</script>';
            }
        }

        ?>

        <!---------------------------------------------------------->
        <br><br>

        <!-- Trigger/Open The Modal -->
        <input type="button" id="myBtn" value="Add an inquiry">

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <hr><br><br>
            <h1>Add an inquiry</h1>
            <h3>Type your message</h3><br>
            <textarea id='tArea' name='inquiryContent' rows="4" cols="80" ></textarea>
            <!--<h4>OR</h4>
            <h3>Add text</h3>
            <textarea id='tArea' name='analysisContent' rows="4" cols="80" ></textarea>-->
            <br><input type='submit' id='addBtn' value ='Add' name='addInquiry'>
        </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
        <!---------------------------------------------------------->


        <?php 

        if(isset($_POST['addInquiry']))
        {
            $_SESSION['user']->makeInquiry($_POST['inquiryContent']);
            echo '<script>javascript:history.go(-1)</script>';
        }

        echo "</form>";
        echo "</div>";

        ?>


    
        <!------------------------------------------------------------------->

</body>
</html>