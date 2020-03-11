<?php

class Admin extends User{

    function addReceptionist($receptionist){
        databaseReceptionistWriter($receptionist);
    }

    function removeUser($user){
        if($user->userType == 1)
            return false;
        else if($user->userType == 2)
            databaseRemovePatient($user->ID);
        else if($user->userType == 3)
            databaseRemoveReceptionist($user->ID);
    }

}

?>