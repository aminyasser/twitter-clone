<?php 

include '../core/init.php';
require_once '../core/classes/validation/Validator.php';

use validation\Validator;

if (User::checkLogIn() === false) 
header('location: index.php');  


$user =User::getData($_SESSION['user_id']);

if (isset($_POST['submit'])) {

    $email =  User::checkInput($_POST['email']) ;
    $username =   User::checkInput($_POST['username']);

    $v = new Validator; 
    $v->rules('username' , $username , ['required' , 'string' , 'max:20']);
    $v->rules('email' , $email , ['required' , 'email']);
    $errors = $v->errors;

    if ($errors == []) {
        
        if(User::checkEmail($email) === true && $email != $user->email) {
            $_SESSION['errors_account'] = ['This email is already use'];
            header('location: ../account.php')  ;
        } else if (User::checkUserName($username) === true && $username != $user->username) {
            $_SESSION['errors_account'] = ['This username is already use'];
            header('location: ../account.php')  ;
        } else if (preg_match("/[^a-zA-Z0-9\!]/" , $username)) {
            $_SESSION['errors_account'] = ['Only Chars and Numbers allowed in username'];
            header('location: ../account.php')  ;
        } else {
        $data = [
            'email' => $email ,
            'username' => $username
        ];

        $sign= User::update('users' , $_SESSION['user_id'], $data); 
        header('location: ../account.php')  ;
    }

    } else {
       
        $_SESSION['errors_account'] = $errors;  
        header('location: ../account.php');

    }
    

} else header('location: ../home.php');

?>