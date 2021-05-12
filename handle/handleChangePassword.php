<?php 

include '../core/init.php';
require_once '../core/classes/validation/Validator.php';

use validation\Validator;

if (User::checkLogIn() === false) 
header('location: index.php');  


$user =User::getData($_SESSION['user_id']);
$username =  User::getUserNameById($_SESSION['user_id']);



if (isset($_POST['submit'])) {

    $old_password =  User::checkInput($_POST['old_password']) ;
    $new_password =  User::checkInput($_POST['new_password']) ;
    $ver_password =  User::checkInput($_POST['ver_password']) ;
    
    $v = new Validator; 
    $v->rules('New Password' , $new_password , ['required' , 'string' , 'min:5']);
    $errors = $v->errors;
    $old_password = md5($old_password);
    if ($old_password == $user->password) {

        if ($errors != []) {
            $_SESSION['errors_password'] = $errors ;
            header('location: ../account.php')  ;
        } else if ($new_password != $ver_password) {
            $_SESSION['errors_password'] = ['The two passwords are not the same'] ;
            header('location: ../account.php')  ;
        } else {
            $new_password = md5($new_password);
            $data = [
                'password' => $new_password ,
            ];
    
            $sign= User::update('users' , $_SESSION['user_id'], $data); 
            header('location: ../' . $username);

        }

    } else { $_SESSION['errors_password'] = ['The old password is wrong'] ;
        header('location: ../account.php')  ;
    }


} else {
    header('location: ../account.php');
}