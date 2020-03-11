<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="ComponentDesign.css">
    <title>Receptionist SignUp</title>
    </head>
    <body>
    <?php require 'Receptionist.php'; ?>
    <?php include 'databaseWriter.php'; ?>
    

    <form name="receptionistForm" action="" method="post">

        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Registration Form</div>
        <div class="panel-body">

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="receptionistName" placeholder="FullName">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type="date" name="receptionistAge" class="form-control" max="2000-12-31" min="1950-01-01">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="text" class="form-control" name="receptionistTelephone" placeholder="Telephone">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="receptionistUsername" placeholder="Username">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="text" class="form-control" name="receptionistPassword" placeholder="Password">
        </div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="text" class="form-control" name="receptionistEmail" placeholder="Email">
        </div>      <br>

        <!--Fullname: <input name="patientName" type="text" />    <br /><br />
        Age: <input type="date" name="patientAge" max="2000-12-31" min="1950-01-01">     <br /><br />
        Telephone: <input name="patientTelephone" type="number" />    <br /><br />
        Username: <input name="patientUsername" type="text" />    <br /><br />
        Password: <input name="patientPassword" type="password" />    <br /><br />
        Email: <input name="patientEmail" type="email" />    <br /><br />   -->

        <input id="submitReceptionistButton" class="btn btn-primary" name="submitButton" type="submit" value="SignUp" /> <br><br>
        
        </div></div></div>

        <?php 
        
        if(isset($_POST['submitButton']))
        {    
            $receptionist = new Receptionist;
            $receptionist->fullName = $_POST['receptionistName'];
            $receptionist->age = $_POST['receptionistAge'];
            $receptionist->telephone = $_POST['receptionistTelephone'];
            $receptionist->username = $_POST['receptionistUsername'];
            $receptionist->password = $_POST['receptionistPassword'];
            $receptionist->email = $_POST['receptionistEmail'];
            
            writeReceptionist($receptionist);
            header("Location:ReceptionistLoginForm.php"); 
            
        }
        
        
        ?>
        

    </form>

    </body>
</html>