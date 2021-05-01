<?php 
	include '../init.php';
	$user_id = $_SESSION['user_id'];
if(isset($_POST['follow']) && !empty($_POST['follow'])){
	$following_id   = $_POST['follow'];
	// $user       = User::getData($user_id);
	date_default_timezone_set("Africa/Cairo");
    //notifyy
    if($following_id != $user_id) {
        $data_notify = [
        'notify_for' => $following_id ,
        'notify_from' => $user_id ,
        'target' => 0, 
        'type' => 'follow' ,
        'time' => date("Y-m-d H:i:s") ,
        'count' => '0' , 
        'status' => '0'
        ];

        Tweet::create('notifications' , $data_notify);
        
    } 
    // end
    $data = [
        'follower_id' => $user_id , 
        'following_id' => $following_id , 
        'time' => date("Y-m-d H:i:s") 
    ];
    Follow::create('follow' , $data);

    echo Follow::countFollowers($following_id);
}
if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){ 
    $following_id   = $_POST['unfollow'];
    
    if($following_id != $user_id) {
        $data = [
          'notify_for' => $following_id ,
          'notify_from' => $user_id ,
          'target' => 0 , 
          'type' => "'follow'" ,
        ];

        Tweet::delete('notifications' , $data);
        
    } 


    Follow::delete('follow' , ['following_id' => $following_id , 'follower_id' => $user_id]);
    echo Follow::countFollowers($following_id);
}
