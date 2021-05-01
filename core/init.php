<?php

// include 'database/connection.php' ;
include 'classes/connection.php' ;
include 'classes/User.php' ;
include 'classes/Follow.php' ;
include 'classes/Tweet.php' ;

session_start();
 
global $pdo;

// instead of using objects and decide to user static function
// $User = new User();
// $getFormFollow = new Follow($conn);
// $getFormTweet = new Tweet($conn);


define("BASE_URL" , "http://localhost/twitter/");



