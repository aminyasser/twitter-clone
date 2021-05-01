<?php  
   
    if (isset($_GET['username']) === true && empty($_GET['username']) === false ) {
        include 'core/init.php';
        $username = User::checkInput($_GET['username']);
        $profileId = User::getIdByUsername($username);
        $profileData = User::getData($profileId);
        $user_id = $_SESSION['user_id'];
        $user = User::getData($user_id);
        $who_users = Follow::whoToFollow($user_id);
        $tweets = Tweet::tweetsUser($profileData->id);
        $liked_tweets = Tweet::likedTweets($profileData->id);
        $media_tweets = Tweet::mediaTweets($profileData->id);
        $notify_count = User::CountNotification($user_id);
      
        if (!$profileData)
            header('location: index.php');

            if (User::checkLogIn() === false) 
            header('location: index.php');    

    }
 
  /*  $ah = " <link rel='stylesheet' href='assets/css/profile_style.css?v=<?php echo time(); ?>'>"; */
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $profileData->name; ?> (@<?php echo $profileData->username; ?>) | Twitter</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/profile_style.css?v=<?php echo time(); ?>">
  
    <link rel="shortcut icon" type="image/png" href="assets/images/twitter.svg"> 
   
</head>
<body>

<script src="assets/js/jquery-3.5.1.min.js"></script>

   
    <div id="mine">
    <div class="wrapper-left">
        <div class="sidebar-left">
          <div class="grid-sidebar" style="margin-top: 12px">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/86d7x4Z/twitter.png" alt="" height="30px" width="30px" />
            </div>
          </div>

          <a href="home.php">
          <div class="grid-sidebar bg-active" style="margin-top: 12px">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/6tKFLWG/home.png" alt="" height="26.25px" width="26.25px" />
            </div>
            <div class="wrapper-left-elements">
              <a href="home.php" style="margin-top: 4px;"><strong>Home</strong></a>
            </div>
          </div>
          </a>
  
          <a href="notification.php">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align position-relative">
                <?php if ($notify_count > 0) { ?>
              <i class="notify-count"><?php echo $notify_count; ?></i> 
              <?php } ?>
              <img
                src="https://i.ibb.co/Gsr7qyX/notification.png"
                alt=""
                height="26.25px"
                width="26.25px"
              />
            </div>
  
            <div class="wrapper-left-elements">
              <a href="notification.php" style="margin-top: 4px"><strong>Notification</strong></a>
            </div>
          </div>
          </a>
        
            <a href="<?php echo BASE_URL . $user->username; ?>">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/znTXjv6/perfil.png" alt="" height="26.25px" width="26.25px" />
            </div>
  
            <div class="wrapper-left-elements">
              <!-- <a href="/twitter/<?php echo $user->username; ?>"  style="margin-top: 4px"><strong>Profile</strong></a> -->
              <a class="wrapper-left-active" href="<?php echo BASE_URL . $user->username; ?>"  style="margin-top: 4px"><strong>Profile</strong></a>
            
            </div>
          </div>
          </a>
          <a href="<?php echo BASE_URL . "account.php"; ?>">
          <div class="grid-sidebar ">
            <div class="icon-sidebar-align">
              <img src="https://i.ibb.co/znTXjv6/perfil.png" alt="" height="26.25px" width="26.25px" />
            </div>
  
            <div class="wrapper-left-elements">
              <a href="<?php echo BASE_URL . "account.php"; ?>" style="margin-top: 4px"><strong>Settings</strong></a>
            </div>
           
            
          </div>
          </a>
          <a href="includes/logout.php">
          <div class="grid-sidebar">
            <div class="icon-sidebar-align">
              <i style="font-size: 26px; color:red" class="fas fa-sign-out-alt"></i>
            </div>
  
            <div class="wrapper-left-elements">
              <a style="color:red" href="includes/logout.php" style="margin-top: 4px"><strong>Logout</strong></a>
            </div>
          </div>
          </a>
          <button class="button-twittear">
            <strong>Tweet</strong>
          </button>
  
          <div class="box-user">
            <div class="grid-user">
              <div>
                <img
                  src="assets/images/users/<?php echo $user->img ?>"
                  alt="user"
                  class="img-user"
                />
              </div>
              <div>
                <p class="name"><strong><?php if($user->name !== null) {
                echo $user->name; } ?></strong></p>
                <p class="username">@<?php echo $user->username; ?></p>
              </div>
              <div class="mt-arrow">
                <img
                  src="https://i.ibb.co/mRLLwdW/arrow-down.png"
                  alt=""
                  height="18.75px"
                  width="18.75px"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
          
  

      <div class="grid-posts">
        <div class="border-right">
          <div class="grid-toolbar-center">
            <div class="center-input-search">
              
            </div>
           
          </div>

          <div class="box-fixed" id="box-fixed"></div>
  
          <div class="box-home feed">
               <div class="container">
                 <div   class="row position-fixed box-name">
                       <div class="col-xs-2">
                       <a href="javascript: history.go(-1);"> <i style="font-size:20px;" class="fas fa-arrow-left arrow-style"></i> </a>
                       </div>
                       <div class="col-xs-10">
                           <span class="home-name"> <?php echo $profileData->name; ?></span>
                           <p class="home-tweets-num">
                              <?php echo Tweet::countTweets($profileData->id); ?> Tweets</p>
                      </div>
                 </div>

                 <div class="row mt-5">
                     
                    <div class="col-md-12">
                      <img class="w-100 home-img-cover" src="assets/images/users/<?php echo $profileData->imgCover; ?>" alt="">
                    </div>

                 </div>

                 <div class="row justify-content-between">
                      <img class="home-img-user" src="assets/images/users/<?php echo $profileData->img; ?>" alt="">
   

                      <?php if ($user->id == $profileData->id) { ?>
                      <button class="home-edit-button" data-toggle="modal" data-target="#edit">Edit Profile</button>
                 
                    <!-- Modal Edit Profile -->
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">

                        <form method="POST" action="handle/handleUpdateData.php" enctype="multipart/form-data">

                            <div style="width: 300%;" class="d-flex justify-content-between">
                            <div>
                            <h5 class="modal-title d-inline" id="exampleModalLongTitle">Edit Profile</h5>
                            </div>
                            <div>

                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                             <!-- btn submit form -->
                            <button type="submit" name="update"  class="btn btn-primary">Save</button>
                            </div>
                                
                         </div>
                            <!-- <span aria-hidden="true">&times;</span> -->
                            
                        </div>
                        <div class="modal-body">
                            <div class="row">
                            <div class="col-md-12">
                            <div class="image-upload">
                                <label for="cover-input">
                                <i style="top: 80px;
                                 left:200px;
                                 color:white;
                                 font-size:18px " class="far fa-images position-absolute"></i> 
                                  </label>
                                  <input id="cover-input" type="file" name="cover"/>
                                  <a href="handle/handleDeleteCover.php" style="top: 80px;
                                 left:260px;
                                 color:red;
                                 font-size:18px " class="fas fa-times position-absolute"></a> 
                               
                                  <img id="preview-cover" class="w-100 home-img-cover" src="assets/images/users/<?php echo $profileData->imgCover; ?>" alt="">
                            </div>
                            </div>

                          
                            <div class="image-upload">
                            
                            <label for="file-input">
                                <i style="top: 240px;
                                 left:100px;
                                 color:white;
                                 font-size:18px;
                                 z-index:20 " class="far fa-images position-absolute"></i> 
                                  </label>
                                <input id="file-input" name="image" type="file"/>
                            </div>


                            <img id="preview-user" class="home-img-user" src="assets/images/users/<?php echo $profileData->img; ?>" alt="">

                            </div>
                            <!-- <form class="" action=""> -->
                            <?php  if (isset($_SESSION['errors'] )) { ?>
                            <script>  
                                $(document).ready(function(){
                            // Open modal on page load
                            $("#edit").modal('show');
                    
                          });
                          </script>
                                    <?php foreach ($_SESSION['errors'] as $error) { ?>
                                          <div  class="alert alert-danger" role="alert">
                                            <p style="font-size: 15px;" class="text-center"> <?php echo $error ; ?> </div>  <?php }  }
                                            unset($_SESSION['errors']) ?> </p>  


                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $user->name; ?>" aria-describedby="emailHelp" placeholder="Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="bio" class="form-control" id="exampleInputEmail1" value="<?php if ($user->bio !== null) 
                            echo $user->bio ;?>" aria-describedby="emailHelp" placeholder="Bio">
                            </div>
                        <div class="form-group">
                        
                            <input type="text" name="website" class="form-control" id="exampleInputEmail1" value="<?php if ($user->website !== null) 
                            echo $user->website ;?>" aria-describedby="emailHelp" placeholder="Website">
                        
                        </div>
                        <div class="form-group">
                            
                            <input type="text" name="location" class="form-control" value="<?php if ($user->location !== null) 
                            echo $user->location ;?>" id="exampleInputPassword1" placeholder="Location">
                        </div>
                        <div class="text-center">
                        <!-- <button type="submit" name="signup" class="btn btn-primary">Sign Up</button> -->
                        </div>
                            </form>
                        </div>
                        
                        </div>
                    </div>
                    </div> 
                    <!-- End Edit Modal -->

                    <?php } else { 
                      $user_follow = Follow::isUserFollow($user_id , $profileData->id) ;
                      ?>
                   <button class=" follow-btn 
                   <?= $user_follow ? 'following' : 'follow' ?>" 
                  data-follow="<?php echo $profileData->id; ?>"> 
                    <?php if($user_follow) { ?>
                        Following 
                      <?php } else {  ?>  
                          Follow
                        <?php }  ?>  
                    </button>
                      <?php } ?> 


                 </div>
                  <div class="home-title">
                    <h4><?php echo $profileData->name; ?></h4>
                    <p class="user-handle" style="color: gray;">@<?php echo $profileData->username; ?>
                    <?php if (Follow::FollowsYou($profileData->id , $user_id)) { ?>
                  <span class="ml-1 follows-you">Follows You</span></p>
                  <?php } ?>
                    <p class="bio"><?php echo $profileData->bio; ?> </p>
                  </div>

                  <div class="row home-loc-link ml-2">
                      <?php if (!empty($profileData->location)) { ?>
                    <div class="col-md-4">
                      <li class=""> <i class="fas fa-map-marker-alt"></i> <?php echo $profileData->location; ?></li>
                    </div>
                    <?php } ?>
                    <?php if (!empty($profileData->website)) { ?>
                    <div class="col-md-4">
                    <li><i class="fas fa-link"></i> 
                    <a href="<?php echo $profileData->website ;?>" target="_blank">
                    <?php echo parse_url($profileData->website, PHP_URL_HOST);; ?>
                  </a> </li>
                    </div>
                    <?php } ?>


                  </div>
                  <div class="row home-follow ml-2 mt-1">
                      <div class="col-md-3">
                          <i class="count-following-i"
                          data-follow = "<?php echo $profileData->id; ?>" >
                           <span class="home-follow-count count-following"><?php echo Follow::countFollowing($profileData->id); ?></span> Followings</i>
                      </div>
                      <div class="col-md-3">
                         <i class="count-followers-i"
                         data-follow = "<?php echo $profileData->id; ?>"> 
                         <span class="home-follow-count count-followers"><?php echo Follow::countFollowers($profileData->id); ?></span> Followers</i>
                      </div>   
                  </div>
                  
                  <div class="popupUsers">
                    
                  </div>

                     <ul class="nav nav-tabs justify-content-center mt-4" id="myTab" role="tablist">
                       <li class="nav-item">
                         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                           Tweets</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                           Media</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                           Likes</a>
                       </li>
                     </ul>
                 
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <?php include 'includes/tweets.php'; ?>
                        
                  </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <?php
                       $tweets = $media_tweets;
                       include 'includes/tweets.php'; ?>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                     
                       <?php
                       $tweets = $liked_tweets;
                       include 'includes/tweets.php'; ?>
                  
                  </div>
                  </div>
            
               </div>
         
          </div>
        </div>
        <div class="wrapper-right">
            <div style="width: 90%;" class="container">

            <div class="input-group py-2 m-auto pr-5 position-relative">

            <i id="icon-search" class="fas fa-search tryy"></i>
            <input type="text" class="form-control search-input"  placeholder="Search Twitter">
            <div class="search-result">


            </div>
            </div>
            </div>



            <div class="box-share">
            <p class="txt-share"><strong>Who to follow</strong></p>
            <?php 
            foreach($who_users as $user) { 
              //  $u = User::getData($user->user_id);
               $user_follow = Follow::isUserFollow($user_id , $user->id) ;
               ?>
          <div class="grid-share">
          <a style="position: relative; z-index:5; color:black" href="<?php echo $user->username;  ?>">
                      <img
                        src="assets/images/users/<?php echo $user->img; ?>"
                        alt=""
                        class="img-share"
                      />
                    </a>
                    <div>
                      <p>
                      <a style="position: relative; z-index:5; color:black" href="<?php echo $user->username;  ?>">  
                      <strong><?php echo $user->name; ?></strong>
                      </a>
                    </p>
                      <p class="username">@<?php echo $user->username; ?>
                      <?php if (Follow::FollowsYou($user->id , $user_id)) { ?>
                  <span class="ml-1 follows-you">Follows You</span></p>
                  <?php } ?></p></p>
                    </div>
                    <div>
                      <button class="follow-btn follow-btn-m 
                      <?= $user_follow ? 'following' : 'follow' ?>"
                      data-follow="<?php echo $user->id; ?>"
                      data-user="<?php echo $user_id; ?>"
                      data-profile="<?php echo $profileData->id; ?>"
                      style="font-weight: 700;">
                      <?php if($user_follow) { ?>
                        Following 
                      <?php } else {  ?>  
                          Follow
                        <?php }  ?> 
                      </button>
                    </div>
                  </div>

                  <?php }?>
         
          
          </div>
  
  
        </div>
      </div> </div>
      
           <script src="assets/js/search.js"></script>
            <script src="assets/js/photo.js"></script>
            <script src="assets/js/follow.js?v=<?php echo time(); ?>"></script>
            <script src="assets/js/users.js?v=<?php echo time(); ?>"></script>
            <script type="text/javascript" src="assets/js/hashtag.js"></script>
          <script type="text/javascript" src="assets/js/like.js"></script>
          <script type="text/javascript" src="assets/js/comment.js?v=<?php echo time(); ?>"></script>
          <script type="text/javascript" src="assets/js/retweet.js?v=<?php echo time(); ?>"></script>
      <script src="https://kit.fontawesome.com/38e12cc51b.js" crossorigin="anonymous"></script>
      <!-- <script src="assets/js/jquery-3.4.1.slim.min.js"></script> -->
      <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>