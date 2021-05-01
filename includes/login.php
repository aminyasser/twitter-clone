<?php

    
?>
    <form action="./handle/handlelogin.php" class="login-box" method="POST">
            <input class="input-box" name="email" type="email"  placeholder="Email">
            <input class="input-box" name="password" type="password" placeholder="Password">
            <a class="login-link" href="#">Forgot password?</a>
            <input type="submit" name="login" class="login-btn" value="Log in"> 
            <div class="con">
    <?php 
    
    if(isset($_SESSION['errors'])) {
          foreach ($_SESSION['errors'] as $error) {
          echo ' <li class="error-li">
          <div class="span-fp-error">'.$error.'</div>
          </li>';
          
          }
          unset($_SESSION['errors']);  

         
          
    } 
        
      ?>
    </div>
    </form>

    
 
	
	