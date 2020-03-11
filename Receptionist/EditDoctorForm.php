<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="validation.js"></script>
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
        .container {
        width: 100%;
        padding-left: 10%;
        }
        .valDiv {
            padding-left: 5%;
            color: red;
        }
    </style>
</head>
<body>
    <?php include 'sideNav.php'; ?>

    <div class='background'>
        <?php
            include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Doctor.php';
            include 'C:\xampp\htdocs\ClinicProject\Classes\Receptionist.php';
            session_start();

            echo "<form action='' method='post'>
                    
                    <div class='container'>
                        <h3>Your Profile</h3>
                        <label for='fname'><i class='fa fa-user'></i> Full Name</label><br>
                        <input class='form-control col-8' type='text' id='fullname' name='fullname' placeholder='John M. Doe' value='".$_SESSION['userToEdit']->fullName."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='fullnameDiv'></div>     <br>
                        <label for='email'><i class=fa fa-envelope'></i> Email</label><br>
                        <input class='form-control col-8' type='text' id='email' name='email' placeholder='john@example.com' value='".$_SESSION['userToEdit']->email."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='emailDiv'></div>     <br>
                        <label for='adr'><i class='fa fa-phone'></i> Telephone</label><br>
                        <input class='form-control col-8' type='text' id='telephone' name='telephone' placeholder='010XXXXXXXX' value='".$_SESSION['userToEdit']->telephone."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='telephoneDiv'></div>     <br>
                        <label for='city'><i class='fa fa-user'></i> Username</label><br>
                        <input class='form-control col-8' type='text' id='username' name='username' placeholder='john123' value='".$_SESSION['userToEdit']->username."' onblur='checkAvailability()' required><br>
                        <div class='valDiv' id='usernameDiv'></div>     <br>
                        <div class='row'>
                            <div class='col-4'>
                                    <label for='state'><i class='fa fa-calendar'></i> Date Of Birth</label>
                                    <input class='form-control' type='date' id='DOB' name='dob' max='2000-12-31' min='1950-01-01' value='".$_SESSION['userToEdit']->dob."' onblur='blurFunction(this.name)' required>
                                    <div class='valDiv' id='dobDiv'></div>     <br>
                            </div>
                        </div>
                        <br>
                        <input class='form-control col-sm-5' type='submit' value='Edit' name='edit'><br>
                    </div>

                </form>";

                
            if(isset($_POST['edit'])){
                $_SESSION['user']->updateDoctorAccount($_SESSION['userToEdit']);
                echo '<script>javascript:history.go(-1)</script>';
            }
        ?>

        <script>
            function checkAvailability() {

                jQuery.ajax({
                url: "CheckUser.php",
                data:'username='+$("#username").val(),
                type: "POST",
                success:function(data){
                $("#usernameDiv").html(data);
                },
                error:function (){}
                });
            }
        </script>

    </div>
</body>
</html>