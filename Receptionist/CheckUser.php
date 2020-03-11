<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


    if(!empty($_POST["username"])) {
        $sql = "select * from user where Username = '".$_POST['username']."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            echo "<span class='status-not-available'> Username Not Available.</span>";
        }
      }

?>