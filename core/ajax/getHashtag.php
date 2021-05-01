<?php 
  include '../init.php';
   if(isset($_POST['hashtag'])){	
   	  if(!empty($_POST['hashtag'])){
   	  	 $hashtag = User::checkInput($_POST['hashtag']);
   	  	 $mention = User::checkInput($_POST['hashtag']);

		  if(substr($hashtag, 0,1) === '#'){
		  	 $trend   = str_replace('#', '', $hashtag);
		  	 $trend   = Tweet::getTrendByHash($trend);
		  	
		  	 foreach ($trend as $hashtag) {
		 	   echo '<li><a href="#"><span class="getValue">#'.$hashtag->hashtag.'</span></a></li>';
		  	 }
		   }

   	  	 if(substr($mention, 0,1) === '@'){
   	  	 	$mention = str_replace('@', '', $mention);
   	  	 	$mentions = Tweet::getMention($mention);
   	  	 	foreach ($mentions as $mention) {
   	  	 	  echo '<li><div class="nav-right-down-inner">
						<div class="nav-right-down-left">
							<span><img src="' .BASE_URL.'assets/images/users/'.$mention->img.'"></span>
						</div>
						<div class="nav-right-down-right">
							<div class="nav-right-down-right-headline">
								<a>'.$mention->name.'</a><span class="getValue">@'.$mention->username.'</span>
							</div>
						</div>
					</div><!--nav-right-down-inner end-here-->
					</li>';
   	  	 	}

   	  	 }
   	  }
   }
 
?>
