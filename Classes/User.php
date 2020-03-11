<?php

class User{
    public $ID;                         //int
    public $fullName;                   //string
    public $dob;                        //string
    public $telephone;                  //string
    public $email;                      //string
    public $username;                   //string
    public $password;                   //string
    public $userType;                   //string

    public static function logIn($un , $pw){
        return (databaseLogIn($un, $pw));
    }
}

?>