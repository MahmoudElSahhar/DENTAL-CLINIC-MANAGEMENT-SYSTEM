<!DOCTYPE html>
<html>
<head>
    <title>Doctor</title>
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
            session_start();

            echo "<form action='' method='post'>
                    
                    <div class='container'>
                        <h3>Your Profile</h3>
                        <label for='fname'><i class='fa fa-user'></i> Full Name</label><br>
                        <input class='form-control col-8' type='text' id='fullname' name='fullname' placeholder='John M. Doe' value='".$_SESSION['user']->fullName."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='fullnameDiv'></div>     <br>
                        <label for='email'><i class=fa fa-envelope'></i> Email</label><br>
                        <input class='form-control col-8' type='text' id='email' name='email' placeholder='john@example.com' value='".$_SESSION['user']->email."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='emailDiv'></div>     <br>
                        <label for='adr'><i class='fa fa-phone'></i> Telephone</label><br>
                        <input class='form-control col-8' type='text' id='telephone' name='telephone' placeholder='010XXXXXXXX' value='".$_SESSION['user']->telephone."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='telephoneDiv'></div>     <br>
                        <label for='city'><i class='fa fa-user'></i> Username</label><br>
                        <input class='form-control col-8' type='text' id='username' name='username' placeholder='john123' value='".$_SESSION['user']->username."' onblur='blurFunction(this.name)' required><br>
                        <div class='valDiv' id='usernameDiv'></div>     <br>
                        <div class='row'>
                            <div class='col-4'>
                                    <label for='state'><i class='fa fa-calendar'></i> Date Of Birth</label>
                                    <input class='form-control' type='date' id='DOB' name='dob' max='2000-12-31' min='1950-01-01' value='".$_SESSION['user']->dob."' onblur='blurFunction(this.name)' required>
                                    <div class='valDiv' id='dobDiv'></div>     <br>
                            </div>
                            &nbsp&nbsp
                            <div class='col-4'>
                                <label for='zip'><i class='fa fa-lock'></i> Password</label>
                                <input class='form-control' type='password' id='password' name='password' value='".$_SESSION['user']->password."' onblur='blurFunction(this.name)' required>
                                <div class='valDiv' id='passwordDiv'></div>     <br>
                            </div>
                        </div>
                        <br>
                        <input class='form-control col-sm-5' type='submit' value='Edit' name='edit'><br>
                        <input class='form-control col-sm-5' type='submit' value='Delete' name='delete'>
                    </div>

                </form>";
            if(isset($_POST['edit'])){
                $_SESSION['user']->updateAccount();
                echo '<script>javascript:history.go(-1)</script>';
            }
            else if(isset($_POST['delete'])){
                $_SESSION['user']->deleteAccount();
                header("Location: http://localhost/ClinicProject/LogInForm.php");
            }
        ?>
    </div>
</body>
</html>