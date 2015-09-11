<?php

namespace controller;

    class logincontroller
    {
    
        
        function TryToLogin($username, $password){
            if($this->authenticate($username, $password)){
                session_start();
                $user = new UserModel($username);
                $_SESSION['user'] = $user;
                
                return true;
            }
                else
                
                return false;
            }
            
        static function authenticate($user, $password){
            $authenic = false;
            
            if($user == 'martin' && $password == '1234') $authenic = true;
            return $authenic;
        } 
        
        function logout(){
            session_start();
            session_destroy();
        }
        
    }
    
    
    
    
     //private $loginview;
       // private $login;
        
    //    function __construct($loginview, $login){
      //      $this->LoginView = loginview;
    //        $this->Login = login;
            
       
       