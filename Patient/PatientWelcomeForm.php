<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Patient Welcome Page</title>

    <style>
        body {
            background-color: black;
        }
        .navbar.navbar-inverse a {
            margin-left: 35px;
        }
        .homeButtonPatientWelcome {
            margin-left: 200px;
        }
        .navbar-brand img {
            max-height: 50px;
            max-width: 50%;
            position: absolute;
            left: 0px;
            top: 0px;
            margin-left: 10px;
        }
        #tbl {
            width: 100%;
            text-align : center;
            background-color: beige;
        }
        #cell {
            color: beige;
            background-color: gray;
        }
        td {
            width: 33%;
            padding: 25px;
        }
        #loginDiv {
            background-color: gray;
            text-align: center;
            color: beige;
        }
        h3 {
            margin-top: 0px;
        }
        #loginBtn {
            width: 30%;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: dodgerblue;
            font-style: bold;
            font-size: 20px;
            color: #f2f2f2;
        }
        #loginBtn:hover {
            background-color: #f2f2f2;
            color: dodgerblue;
            font-style: bold;
            font-size: 20px;
            border: 1px solid dodgerblue;
        }

    </style>
</head>
<body>

        <?php include'C:\xampp\htdocs\ClinicProject\Classes\User.php'; ?>
        <?php include'C:\xampp\htdocs\ClinicProject\Classes\Patient.php'; ?>
        <?php include'C:\xampp\htdocs\ClinicProject\Classes\Inquiry.php'; ?>
        <?php include'C:\xampp\htdocs\ClinicProject\Database\database.php'; ?>

        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="PatientWelcomeForm.php"><img class="d-inline-block align-top" src="http://web.ssdentalclinicltd.com/wp-content/uploads/2016/01/SS-DENTAL-CLINIC-LOGO.png"></a>
            </div>
            <ul class='nav navbar-nav'>
            <li class='homeButtonPatientWelcome'><a href='PatientWelcomeForm.php'>Home</a></li>
            <li><a href='PatientProfileForm.php'>My Account</a></li>
            <li><a href='MyAppointmentsForm.php'>Appointments</a></li>
            <li><a href='AnalysisForm.php'>Analysis</a></li>
            <li><a href='PrescriptionForm.php'>Prescription</a></li>
            <li><a href='InquiryForm.php'>Inquiries</a></li>
            </ul>
        </div>
        <img id="img" src="https://www.flossdentalsurrey.ca/wp-content/themes/floss-dental/img/banner4.jpg" height="500" width="100%">
        <div  id="loginDiv">
            <br>
            <h3>Join our care center</h3>
        <button type="button" id="loginBtn" onclick="window.location.href='http://localhost/ClinicProject/LogInForm.php'">LogIn</button>
            <br>
        <br>
        </div>
        <div>
        <table id="tbl">
        <tr>
        <td>
            <h2>Success Rates</h2>
            <img src="https://www.continuity.net/hs-fs/hubfs/90percent-2.png?t=1540226265667&width=496&name=90percent-2.png" width="30%"> <br>
            <b>As one of New Cairo area’s most prominent places for quality dental healthcare, Cairo Smile specializes in a wide range of
             dental services.</b>
        </td>
        <td id="cell">
            <h2>Working hours</h2>
            <img src="https://cdn4.iconfinder.com/data/icons/customer-support/500/all_year-512.png" width="30%"> <br>
            <b>We are one of the few dental care centers which offers a 24/7 hours of service and a realtime online appointments booking.</b>
        </td>
        <td>
            <h2>Doctors skills</h2>
            <img src="https://doctourismo.fr/wp-content/uploads/2017/11/194917.png" width="30%"> <br>
            <b>By nature of their general training, a licensed dentist can carry out most dental treatments such as restorative 
            (dental restorations, crowns, bridges).</b>
        </td>
        </tr>
        </table>
        </div>
        </nav>
        


</body>
</html>