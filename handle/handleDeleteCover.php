<?php 

include '../core/init.php';

if (User::checkLogIn() === false) 
header('location: index.php');   

$username =  User::getUserNameById($_SESSION['user_id']);

$user =User::getData($_SESSION['user_id']);

$currentCover = $user->imgCover;

if ($currentCover !== 'cover.png')
unlink('../assets/images/users/' . $currentCover);



$data = [
        'imgCover' => 'cover.png' ,
 ];
 
 $sign= User::update('users' , $_SESSION['user_id'], $data); 


 if ($sign == true) {
    header('location: ../' . $username);
 } else header('location: ../' . $username);
 
 
 

?>