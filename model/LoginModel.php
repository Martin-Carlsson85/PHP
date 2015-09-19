<?php

namespace model;

    class LoginModel{
        
        private $username = 'Admin';
        private $password = 'Password';
        
        function __construct(){
        }
        
        function CheckUsernamnandPassword($username, $password){
            if(empty ($this->username)){
                return 'Username is missing';
            }
            if(empty ($this->password)){
                return 'Password is missin';
            }
        }
        
        
        
    //     private $username = martin;
    //     private $password = "1234";
    //     private $errorsMessage = "You forgot to enter username and password";
    //     private $errorsMessage2 = "You have enter wrong username and password";
        
    //     function __construct($username, $password, $errorsMessage, $errorsMessage2){
    //         $this->username = $username;
    //     }
      
    // //kolla om anändarnamn och lösen
    // function CheckIfLogin($indata){
    //     //Undersöker om användarnamn och lösen är tomma eller inte 
    //     if(empty($indata["username"]) || empty($indata["password"])){
    //         $this->errorMessage;
    //         return false;
            
    //     }
    //     //Jämför användarnamn och lösen med det rätta
    //     if($inputs["username"] !== $this->username || $inputs["password"] !== $this->password){ 
    //         $this->errorsMessage2;
    //         return false;
    
    //     }
    //     return true;
    
    // }
    
    // function getusername(){
    //     return $this->username;
    // }
    
    // function getpassword(){
    //     return $this->password;
    // }

    // function setusername(){
    //     $this->username = $username;
    // }

    // function setpassword(){
    //     $this->password = $password;
    // }
    
    
}
