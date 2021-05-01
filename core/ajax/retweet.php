<?php 
	include '../init.php';
	$user_id = $_SESSION['user_id'];
	date_default_timezone_set("Africa/Cairo");
	if(isset($_POST['qoute']) && !empty($_POST['qoute'])){
		$tweet_id  = $_POST['qoute'];
		$get_id    = $_POST['user_id'];
		$flag = $_POST['isQoute'];
		$qoq = $_POST['qoq'];
		$comment   = User::checkInput($_POST['comment']);

		$retweet = Tweet::getRetweet($tweet_id);
		

		// for notification
		if(isset($retweet->user_id))
		$for_user = $retweet->user_id;
		else $for_user = Tweet::getTweet($tweet_id)->user_id;	

		if($for_user != $user_id) {
			$data_notify = [
              'notify_for' => $for_user ,
			  'notify_from' => $user_id ,
			  'type' => 'qoute' ,
			   'time' => date("Y-m-d H:i:s") ,
			   'count' => '0' , 
			   'status' => '0'
			];
				
		} 


		// check if user retweeted it to avoid double retweet from qoute btn
		if ($flag == false && $qoq == false && Tweet::isRetweet($tweet_id)) {
			$flag_retweeted = Tweet::userRetweeetedIt($user_id,$retweet->tweet_id);
		} else $flag_retweeted = Tweet::userRetweeetedIt($user_id,$tweet_id);
		

        //  if(!$flag_retweeted) {
			date_default_timezone_set("Africa/Cairo");

			$data = [
				'user_id' => $_SESSION['user_id'] , 
				'post_on' => date("Y-m-d H:i:s") ,
			];
			// create function can handle with all tables and return last inserted id
			$post_id =   User::create('posts' , $data);
			// qoq is check if this tweet qoute of qoute or not
			if ($comment != '') {
	
			// if flag true then the retweeted post is qoute tweet and the fk is retweet_id
					if ($flag && !$qoq) {
						if(Tweet::isRetweet($tweet_id)) {

							$data_tweet = [
								'post_id' => $post_id ,
								'retweet_msg' => $comment , 
								'retweet_id' => $retweet->post_id ,
								'tweet_id' => null
							];
							// for notification
								if($for_user != $user_id) 
								$data_notify['target']= $post_id;
							
						} else {
                            $data_tweet = [
								'post_id' => $post_id ,
								'retweet_msg' => $comment , 
								'retweet_id' => $tweet_id ,
								'tweet_id' => null
							];
							// for notification
							if($for_user != $user_id) 
							$$data_notify['target']= $post_id;
						}
						
					} else if ($qoq) {

							if ($retweet->retweet_msg == null ) {
							$data_tweet = [
								'post_id' => $post_id ,
								'retweet_msg' => $comment , 
								'retweet_id' => $retweet->post_id ,
								'tweet_id' => null
							];
							// for notification
							if($for_user != $user_id) 
							$data_notify['target']= $post_id;

						}	else {
							$data_tweet = [
								'post_id' => $post_id ,
								'retweet_msg' => $comment , 
								'retweet_id' => $tweet_id ,
								'tweet_id' => null
							];
							// for notification
							if($for_user != $user_id) 
							$data_notify['target']= $post_id;
						}
	
	
					} else {
							if(Tweet::isRetweet($tweet_id)) {
								$data_tweet = [
									'post_id' => $post_id ,
									'retweet_msg' => $comment , 
									'tweet_id' => $retweet->tweet_id ,
									'retweet_id' => null
								];
								// for notification
							if($for_user != $user_id) 
							$data_notify['target']= $post_id;
							} else {
								$data_tweet = [
									'post_id' => $post_id ,
									'retweet_msg' => $comment , 
									'tweet_id' => $tweet_id ,
									'retweet_id' => null
								]; 
								// for notification
							    if($for_user != $user_id) 
								$data_notify['target']= $post_id;
							}
					}
		} else if ($comment == '') {
	          
			 $data_notify['type'] = 'retweet';

			if ($flag) {
				if(Tweet::isRetweet($tweet_id)) {
					$data_tweet = [
						'post_id' => $post_id ,
						'retweet_msg' => null , 
						'retweet_id' => $retweet->post_id,
						'tweet_id' => null
					];
					// for notification
				if($for_user != $user_id) 
				$data_notify['target']=$retweet->post_id;
				} else {
					$data_tweet = [
						'post_id' => $post_id ,
						'retweet_msg' => null , 
						'retweet_id' => $tweet_id,
						'tweet_id' => null
					];
					// for notification
					if($for_user != $user_id) 
					$data_notify['target']= $tweet_id;
				}
			} else if ($qoq) {

	            if ($retweet->retweet_msg == null ) {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $retweet->post_id ,
					'tweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']=$retweet->post_id;

			   } else {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $tweet_id ,
					'tweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']= $tweet_id;

			   } 
	
	
			} else {
	
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'tweet_id' => $tweet_id,
					'retweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']= $tweet_id;
			}
	
	
	
	
		}
			User::create('retweets' , $data_tweet);

			  // for notification
		if($for_user != $user_id) 
		Tweet::create('notifications' , $data_notify);

		//  }
		
		
		// echo `<div class="tmp d-none">
        //      `+ Tweet::countRetweets($tweet_id) +`            
		// </div>` ;

	}
	if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
		$tweet_id  = $_POST['retweet'];
		$get_id    = $_POST['user_id'];
		$flag = $_POST['isQoute'];
		$qoq = $_POST['qoq'];
		$retweet = Tweet::getRetweet($tweet_id);

		// for notification
		if(isset($retweet->user_id))
		$for_user = $retweet->user_id;
		else $for_user = Tweet::getTweet($tweet_id)->user_id;	

		if($for_user != $user_id) {
			$data_notify = [
              'notify_for' => $for_user ,
			  'notify_from' => $user_id ,
			  'type' => 'retweet' ,
			   'time' => date("Y-m-d H:i:s") ,
			   'count' => '0' , 
			   'status' => '0'
			];
				
		} 

		date_default_timezone_set("Africa/Cairo");

        $data = [
            'user_id' => $_SESSION['user_id'] , 
            'post_on' => date("Y-m-d H:i:s") ,
        ];
        // create function can handle with all tables and return last inserted id
		$post_id =   User::create('posts' , $data);

		 // if flag true then the retweeted post is qoute tweet and the fk is retweet_id
		 if ($flag) {
				if(Tweet::isRetweet($tweet_id)) {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $retweet->post_id,
					'tweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']= $retweet->post_id;

			} else {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $tweet_id,
					'tweet_id' => null
				];
					// for notification
					if($for_user != $user_id) 
					$data_notify['target']=  $tweet_id;

			}
		} else if ($qoq) {

			if(Tweet::isRetweet($tweet_id) && $retweet->retweet_msg == null) {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $retweet->post_id,
					'tweet_id' => null
				];
					// for notification
					if($for_user != $user_id) 
					$data_notify['target']= $retweet->post_id;
			} else {
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'retweet_id' => $tweet_id,
					'tweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']=  $tweet_id;
			}


		} else {
			
			if (Tweet::isRetweet($tweet_id)) {
				   
				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'tweet_id' => $retweet->tweet_id,
					'retweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']= $retweet->tweet_id;

			} else {

				$data_tweet = [
					'post_id' => $post_id ,
					'retweet_msg' => null , 
					'tweet_id' => $tweet_id,
					'retweet_id' => null
				];
				// for notification
				if($for_user != $user_id) 
				$data_notify['target']= $tweet_id;
			}
		}

		User::create('retweets' , $data_tweet);
		
	    // for notification
		if($for_user != $user_id) 
		    Tweet::create('notifications' , $data_notify);
       
		
		echo `<div class="tmp d-none">
             `+ Tweet::countRetweets($tweet_id) +`            
		</div>` ;


	}
	if(isset($_POST['unretweet']) && !empty($_POST['unretweet'])){

        $tweet_id  = $_POST['unretweet'];
		$user_id    = $_POST['user_id'];
        
		$retweet = Tweet::getRetweet($tweet_id);

		// for notification
		if(isset($retweet->tweet_id)) {
		$for_user = Tweet::getTweet($retweet->tweet_id)->user_id; 
		$target = $retweet->tweet_id;
	   } else {
		   $for_user = Tweet::getRetweet($retweet->retweet_id)->user_id;	
	       $target = $retweet->retweet_id;
	   }
	
	
		if($for_user != $user_id) {
			$data = [
              'notify_for' => $for_user ,
			  'notify_from' => $user_id ,
			  'target' => $target , 
			  'type' => "'retweet'" ,
			];
	        
			// var_dump($data);
			// die();

			Tweet::delete('notifications' , $data);
			
		} 
		Tweet::undoRetweet($user_id , $tweet_id );
		
		echo `<div class="tmp d-none">
             `+ Tweet::countRetweets($tweet_id) +`            
		</div>` ;

	}
	if(isset($_POST['option']) && !empty($_POST['option'])){ 
		$tweet_id  = $_POST['option'];
		$get_id    = $_POST['user_id'];
		$user_retweeted_it = $_POST['retweeted'];
		$retweet_sign = $_POST['sign'];
		$retweet_comment = $_POST['tmp'];
		$qoq = $_POST['qoq'];
		if(isset($_POST['status']))
		 $status = $_POST['status'];
		 else $status = false;

		$flaga = false;
		if($retweet_sign && $user_retweeted_it) {
		$retweeted_user = Tweet::getRetweet($tweet_id); 
		    	if ($retweeted_user->user_id != $user_id) {
                       $flaga = true;
		     	} 

			    
			        
	    }
        // $tweet_id_retweeted = Tweet::likedTweetRealId($tweet_id);
		
		// if ($user_retweeted_it && !$retweet_sign) {
		// 	$retweet = Tweet::getRetweet($tweet_id);
		// 	$user_retweeted_itt =Tweet::userRetweeetedIt($user_id , $retweet->id);
		// } else {
			
		// 	$user_retweeted_itt =$user_retweeted_it;
		// }
	    //   $user_retweeted_it = Tweet::checkRetweet($user_id , $tweet_id);
		
		// $retweet = Tweet::getRetweet($tweet_id);
		// $user_retweeted_itt = Tweet::userRetweeetedIt($user_id ,$tweet_id);
	?>

                    <div class="retweet-div">
							<a href="#" 
							class="<?=$user_retweeted_it ? 'retweeted-i' : 'retweet-i' ?>"
							data-user="<?php echo $user_id; ?>"
							data-tweet="<?php 
							if(($user_retweeted_it && !$retweet_sign) || $flaga) {
								if($flaga == false)
							       echo Tweet::retweetRealId($tweet_id ,$user_id);
						     	else {
									if($retweeted_user->tweet_id != null)
										echo Tweet::retweetRealId($retweeted_user->tweet_id ,$user_id);
									else echo Tweet::retweetRealId($retweeted_user->retweet_id ,$user_id);
								 } 
							} else echo $tweet_id;  ?>"
							 data-qoq="<?php echo $qoq; ?>"
							 data-status="<?php echo $status; ?>"
							 >  
								<li ><i class="fas fa-retweet icon"></i> 
								<span class="option-text"><?php if($user_retweeted_it) echo 'Undo';  ?>
								Retweet</span></li>
							</a>
							<a href="#"
							class="qoute"
							data-user="<?php echo $get_id; ?>"
							data-tweet="<?php 
							$retweet = Tweet::getRetweet($tweet_id);
							// if(Tweet::isRetweet($tweet_id) && $retweet->retweet_msg != null)
							// echo $retweet->tweet_id;
							// else
							 echo $tweet_id; ?>"> 
								 <li><i class="fas fa-pencil-alt icon"></i> 
								 <span class="option-text"> Qoute Tweet</span></li>
							</a>
                    </div>

<?php	} 

	if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
		$tweet_id   = $_POST['showPopup'];
		$user       = User::getData($user_id);
		$retweet_comment = false;
		$qoq = false;
		if (Tweet::isRetweet($tweet_id)) {
		$retweet =Tweet::getRetweet($tweet_id);
		if ($retweet->retweet_id == null) {

				// when the retweetd tweet is normal tweet
				
			if ($retweet->retweet_msg != null) {
				
				// when qoute 

                $user_tweet = User::getData($retweet->user_id) ;
				 $timeAgo = Tweet::getTimeAgo($retweet->post_on) ; 
				 $qoute = $retweet->retweet_msg;
                 $retweet_comment = true;
           

              $tweet_inner = Tweet::getTweet($retweet->tweet_id);
              $user_inner_tweet = User::getData($tweet_inner->user_id) ;
              $timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on); 


			} else {
				// when normal retweet

				$tweet      = Tweet::getTweet($retweet->tweet_id);
		    	$user_tweet = User::getData($tweet->user_id);
		    	$timeAgo = Tweet::getTimeAgo($tweet->post_on) ; 
			}
		} else {
			// if tweet_id = null and retweeted_id not null then it's retweet od qoute
			// so we have to get the retweeted tweet first

			// here condtion of retweeted a qouted tweet
		
			if ($retweet->retweet_msg == null) {
				
				$retweeted_tweet = Tweet::getRetweet($retweet->retweet_id);

				if($retweeted_tweet->tweet_id != null) {
						$user_tweet = User::getData($retweeted_tweet->user_id) ;
						$timeAgo = Tweet::getTimeAgo($retweeted_tweet->post_on) ; 

						$retweet_inner = Tweet::getRetweet($retweet->retweet_id);

						$qoute = $retweet_inner->retweet_msg;
						$retweet_comment = true;
				

					
					$tweet_inner = Tweet::getTweet($retweet_inner->tweet_id);
					$user_inner_tweet = User::getData($tweet_inner->user_id) ;
					$timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on); 

				} else {
					// hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee

					     $user_tweet = User::getData($retweeted_tweet->user_id) ;
						$timeAgo = Tweet::getTimeAgo($retweeted_tweet->post_on) ; 

						$retweet_inner = Tweet::getRetweet($retweet->retweet_id);

						$qoute = $retweet_inner->retweet_msg;
						$retweet_comment = true;
				        $qoq = true;

					
					$tweet_inner = Tweet::getRetweet($retweeted_tweet->retweet_id);
					// $tweet_inner = Tweet::getRetweet($tweet_inner->retweet_id);
					$user_inner_tweet = User::getData($tweet_inner->user_id) ;
					$timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on); 
                    $inner_qoute = $tweet_inner->retweet_msg;

				}
			} else {

				// here must handle the qoute of qoute display

				$user_tweet = User::getData($retweet->user_id) ;
				$timeAgo = Tweet::getTimeAgo($retweet->post_on) ; 
				// $likes_count = Tweet::countLikes($tweet->id) ;
				// $user_like_it = Tweet::userLikeIt($user_id ,$tweet->id);
				// $retweets_count = Tweet::countRetweets($tweet->id) ;
				// $user_retweeted_it = Tweet::userRetweeetedIt($user_id ,$tweet->id);
				$qoute = $retweet->retweet_msg;
				$qoq = true; // stand for qoute of qoute
				
				$tweet_inner = Tweet::getRetweet($retweet->retweet_id);
				$user_inner_tweet = User::getData($tweet_inner->user_id) ;
				$timeAgo_inner = Tweet::getTimeAgo($tweet_inner->post_on);
				$inner_qoute = $tweet_inner->retweet_msg;
			}
			
		}	

	} else {

		 // when normal tweet

		$tweet      = Tweet::getTweet($tweet_id);
		$user_tweet = User::getData($tweet->user_id);
		$timeAgo = Tweet::getTimeAgo($tweet->post_on) ;
		

	}
	
?>
<div class="retweet-popup">
<div class="wrap5">
	<div class="retweet-popup-body-wrap">
		<div class="retweet-popup-heading">
			<h3>Quote Tweet</h3>
			<span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
		</div>
		<div class="retweet-popup-input">
			<div class="retweet-popup-input-inner">
				<input  class="retweet-msg" type="text" placeholder="Add Quote"/>
			</div>
		</div>
		
				
		<div class="grid-tweet py-2">
              <div>
                <img
                  src="assets/images/users/<?php echo $user_tweet->img; ?>"
                  alt=""
                  class="img-user-tweet"
                />
              </div>
  
              <div>
                <p>
                  <strong> <?php echo $user_tweet->name ?> </strong>
                  <span class="username-twitter">@<?php echo $user_tweet->username ?> </span>
                  <span class="username-twitter"><?php echo $timeAgo ?></span>
                </p>
                <p>
				<?php
                  // check if it's qoute or normal tweet
                  if ($retweet_comment || $qoq)
                  echo  Tweet::getTweetLinks($qoute);
                  else echo  Tweet::getTweetLinks($tweet->status); ?>
				</p>
				
				<?php if ($retweet_comment == false && $qoq == false) { ?>
                <?php if ($tweet->img != null) { ?>
                <p class="mt-post-tweet">
                  <img
                    src="assets/images/tweets/<?php echo $tweet->img; ?>"
                    alt=""
                    class="img-post-retweet"
                  />
                </p>
			   <?php } ?>
			   <?php }  else { ?>

				<div  class="mt-post-tweet comment-post">

				<div class="grid-tweet py-3  ">
				<div>
				<img
				src="assets/images/users/<?php echo $user_inner_tweet->img; ?>"
				alt=""
				class="img-user-tweet"
				/>
				</div>

				<div>
				<p>
				<strong> <?php echo $user_inner_tweet->name ?> </strong>
				<span class="username-twitter">@<?php echo $user_inner_tweet->username ?> </span>
				<span class="username-twitter"><?php echo $timeAgo_inner ?></span>
				</p>
				<p>
				<?php 
				    if ($qoq)
                    echo $inner_qoute;
                    else  echo  Tweet::getTweetLinks($tweet_inner->status); ?>
				</p>
				<?php
				if($qoq == false) {
				if ($tweet_inner->img != null) { ?>
				<p class="mt-post-tweet">
				<img
				src="assets/images/tweets/<?php echo $tweet_inner->img; ?>"
				alt=""
				class="img-post-retweet"
				/>
				</p>
         <?php } } ?>

</div>
</div>
	   

</div>

<?php } ?>
			   

	</div>
</div>


		<div class="retweet-popup-footer"> 
			<div class="retweet-popup-footer-right">
				<button class="qoute-it" 
				data-tweet="<?php echo $tweet_id;?>"
				data-user="<?php echo $user_id;?>"
				data-tmp="<?php echo $retweet_comment; ?>" 
				data-qoq="<?php echo $qoq; ?>" 
			 type="submit"><i class="fas fa-pencil-alt" aria-hidden="true"></i>Qoute</button>
			</div>
		</div> 
		

</div>

<!-- Retweet PopUp ends-->
<?php }?>
