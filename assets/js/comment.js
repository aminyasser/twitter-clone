$(function(){
	

		$(document).on('click','.comment', function(){
			var tweet_id    = $(this).data('tweet');
			var user_id     = $(this).data('user');
			$counter        = $(this).find(".likes-count");
			$count          = $counter.text();
			$button         = $(this);
			
			
	   	console.log(tweet_id);
           console.log(user_id);
			$.post('core/ajax/comment.php', {showPopup:tweet_id,user_id:user_id}, function(data){
				$('.popupComment').html(data);
				 
				$('.close-retweet-popup').click(function(){
					$('.retweet-popup').hide();
				})
			});
		});



	$(document).one('click', '.comment-it', function(event){
		$('.retweet-popup').addClass('active');
		var tweet_id   = $(this).data('tweet');
		var user_id    = $(this).data('user');
		// var flag   = $(this).data('tmp');
		// var qoq   = $(this).data('qoq');
		
	

		// tricky hint each function to select one class only
       var comment ;
		$('.retweet-msg').each(function(){
		comment =	$(this).val()
		});
        // event.stopImmediatePropagation();
		
		// console.log(tweet_id);
		// console.log(user_id);
        // console.log(comment);
	
	    $.post('core/ajax/comment.php', {qoute:tweet_id,user_id:user_id,comment:comment}, function(data){
			
		   $('.retweet-popup').hide();
           $('.comments').html(data);

	   location.reload();
	   
	    	// $counter.text(data);
	    	// $button.removeClass('retweet').addClass('retweeted');
	    });

	});




    $(document).on('click','.reply', function(){
        var tweet_id    = $(this).data('tweet');
        var user_id     = $(this).data('user');
        $counter        = $(this).find(".likes-count");
        $count          = $counter.text();
        $button         = $(this);
        
        
       console.log(tweet_id);
       console.log(user_id);
        $.post('core/ajax/comment.php', {showReply:tweet_id,user_id:user_id}, function(data){
            $('.popupComment').html(data);
             
            $('.close-retweet-popup').click(function(){
                $('.retweet-popup').hide();
            })
        });
    });



$(document).one('click', '.reply-it', function(event){
    $('.retweet-popup').addClass('active');
    var comment_id   = $(this).data('tweet');
    var user_id    = $(this).data('user');
    // var flag   = $(this).data('tmp');
    // var qoq   = $(this).data('qoq');
    


    // tricky hint each function to select one class only
   var comment ;
    $('.retweet-msg').each(function(){
    comment =	$(this).val()
    });
    // event.stopImmediatePropagation();
    
    // console.log(comment_id);
    // console.log(user_id);
    // console.log(comment);

    $.post('core/ajax/comment.php', {reply:comment_id,user_id:user_id,comment:comment}, function(data){
        
       $('.retweet-popup').hide();
       $('.comments').html(data);

   location.reload();
   
        // $counter.text(data);
        // $button.removeClass('retweet').addClass('retweeted');
    });

});
});