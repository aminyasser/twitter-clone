$(function(){

$(document).on('click','.follow-btn', function(e){
    let follow_id    = $(this).data('follow');
    let user    = $(this).data('user');
    let profile    = $(this).data('profile'); 
    let following , followers;
    
    $button = $(this);
    if($button.hasClass('follow')) {
        // alert(follow_id);
      $.post('core/ajax/follow.php', {follow:follow_id}, function(data){
			//  alert(data);
                $button.addClass('following');
                $button.removeClass('follow');
                $button.text("Following");
                if (user == profile && profile != null) {
                 following = $('.count-following').html() ;
                 following++;
                 $('.count-following').html(following);
                }
                if (profile == null)
                    $('.count-followers').html(data);
            
        // $counter.text(data);
        // $button.removeClass('retweeted').addClass('retweet');
        // $c.removeClass('retweeted-i').addClass('retweet-i');			

     });
    } else {
        $.post('core/ajax/follow.php', {unfollow:follow_id}, function(data){
            $button.addClass('follow');
            $button.removeClass('following');
            $button.text("Follow");
              
            if (user == profile && profile != null) {
                following = $('.count-following').html() ;
                following--;
                $('.count-following').html(following);
               }
               if (profile == null)
                   $('.count-followers').html(data);

          
            // $counter.text(data);
            // $button.removeClass('retweeted').addClass('retweet');
            // $c.removeClass('retweeted-i').addClass('retweet-i');			
    
         });
    }
     


});

$(document).on('mouseover' , '.following' , function(e) {
         
    $(this).html("Unfollow");

});
$(document).on('mouseout' , '.following' , function(e) {
         
    $(this).html("Following");

});


});