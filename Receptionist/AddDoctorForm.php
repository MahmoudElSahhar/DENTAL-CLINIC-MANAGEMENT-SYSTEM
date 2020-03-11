<!DOCTYPE html>
<html>
<head>
    <title>Create New Doctor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link  type="text/css" rel="stylesheet" href="ComponentDesign.css">
    <script type="text/javascript" src="validation.js"></script>
    <link rel="stylesheet" href="MyCSS.css">

    <style>
        input[type="submit"] {
            background-color: green;
            border-color: green;
        }

        .panel > .panel-heading {
            background-color: green;
        }
        .panel {
            border-color: green;
            margin-left:-150px;
        }
        #submitPatientButton:hover {
            border-color: green;
            background-color: #ffffff;
            color: green;
            font-weight: bold;
        }
        h3 {
            color: black;
            font-size: 20px;
        }



    </style>

</head>
<body>

        <?php
            include 'sideNav.php';
            session_start();
        // include 'C:\xampp\htdocs\ClinicProject\Database\database.php';
        ?>
        <div class='background'>

        <h1>Create New Doctor Account</h1>

        <form action="" method="post" name="doctor">

        <!------------------------------------------------------------------------------->
        <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Registration Form</div>
        <div class="panel-body">

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="FullName" onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="fullnameDiv"></div>     <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type="date"  id="dob" name="dob" class="form-control" max="2010-12-31" min="1950-01-01" onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="dobDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="telephoneDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="username" name="username" pattern='[A-Za-z\\s]*' placeholder="Username"  onblur="checkAvailability()" required>
        </div> <div class="valDiv" id="usernameDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="passwordDiv"></div>      <br>

        <div class="input-group col-xs-7">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"  onblur="blurFunction(this.name)" required>
        </div> <div class="valDiv" id="emailDiv"></div>      <br>

        
        <!------------------------------------------------------------------------------->

            <h3>Availabily Time :</h3>
            <br>
            <?php
                ob_start();
                $days = array ("Sunday &nbsp;&nbsp;&nbsp;","Monday &nbsp;&nbsp;&nbsp;","Tuesday &nbsp;&nbsp;","Wednesday","Thursday &nbsp;","Friday &nbsp;&nbsp;&nbsp;","Saturday &nbsp;");
                for($i = 0 ; $i < count($days) ; $i++){
                    echo "<div class='form-group col-md-4'>";
                    echo "<label class='checkbox-inline'><input type='checkbox' name='checkbox[]' value=".$i.">";
                    echo "".$days[$i]."";
                    echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> from </b>
                    <select class='form-control'> name='from[]'>";
                        for($am = 8 ; $am < 12 ; $am++){
                            echo "<option value='".$am.":00'>".$am." AM</option>";
                        }
                        echo "<option value='12:00'>12 PM</option>";
                        for($pm = 1 ; $pm < 7 ; $pm++){
                            echo "<option value='".($pm + 12).":00'>".$pm." PM</option>";
                        }
                    echo "</select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> to </b>
                    <select class='form-control' name='to[]'>";
                        for($am = 8 ; $am < 12 ; $am++){
                            echo "<option value='".$am.":00'>".$am." AM</option>";
                        }
                        echo "<option value='12:00'>12 PM</option>";
                        for($pm = 1 ; $pm < 7 ; $pm++){
                            echo "<option value='".($pm + 12).":00'>".$pm." PM</option>";
                        }
                    echo "</select></label>";
                    echo "<br>";
                    echo "<br></div>";
                }
            ?>

            <input id="submitPatientButton" class="btn btn-primary" name="addDoctor" type="submit" value="SignUp" /> <br><br>
            </div></div></div></div>

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

        <?php
            if(isset($_POST['addDoctor'])){
                
                $_SESSION['user']->addDoctor();
                //echo ($_SESSION['user']->ID);
                echo '<script>javascript:history.go(-1)</script>';
            }
        ?>
        </form>
    
</body>
</html>