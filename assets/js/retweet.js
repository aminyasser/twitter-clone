$(function(){
	
	
	$(document).on('click','.option', function(e){
		var tweet_id    = $(this).data('tweet');
		var user_id     = $(this).data('user');
		var retweeted_it     = $(this).data('retweeted');
		var status     = $(this).data('status');

	    $counter        = $(this).find(".likes-count");
	    $count          = $counter.text();
	    $button         = $(this);
		$op = $(this).next();
		// $op = $(this).find('.options');
		var flag   = $(this).data('tmp');
		var sign  = $(this).data('sign');
		var qoq   = $(this).data('qoq');
       
		

				
		$.post('core/ajax/retweet.php', {option:tweet_id,user_id:user_id,retweeted:retweeted_it , sign:sign , tmp:flag,qoq:qoq , status:status}, function(data){
			$op.html(data);
		
			
			$(document).click(function(e){
				if( $(e.target).closest('.options').length > 0 ) {
					return false;
				}
			    
				$('.retweet-div').hide();
			})
		});
		
       

		$(document).one('click','.retweet-i', function(event){
			var tweet_id    = $(this).data('tweet');
			var user_id     = $(this).data('user');
			$c = $(this);

			var qoq   = $(this).data('qoq');
			// event.stopPropagation();
           event.stopImmediatePropagation();
			
			
			$.post('core/ajax/retweet.php', {retweet:tweet_id,user_id:user_id,isQoute:flag,qoq:qoq}, function(data){
				// $('.popupTweet').html(data);

				$counter.text(data);
	    	$button.removeClass('retweet').addClass('retweeted');
	        $c.removeClass('retweet-i').addClass('retweeted-i');			
			$('.retweet-div').hide();

			// $.ajax({
			// 	url: 'http://localhost/twitter/home.php',
			// 	success: function(data) {
				  
			// 		window.location.reload(); // This is not jQuery but simple plain ol' JS
				  
			// 	}
			//   });
			  
			location.reload();
			});
			

		
			
		});


		
		$(document).one('click','.retweeted-i', function(event){
			var tweet_id    = $(this).data('tweet');
			var user_id     = $(this).data('user');
			var status     = $(this).data('status');

			$c = $(this);
			
			event.stopImmediatePropagation();
		    console.log(tweet_id);
			$.post('core/ajax/retweet.php', {unretweet:tweet_id,user_id:user_id}, function(data){
				 
					//  if (data == 0)
					//   $counter.text('');
					// else 
				$counter.text(data);
				$button.removeClass('retweeted').addClass('retweet');
				$c.removeClass('retweeted-i').addClass('retweet-i');			

				$('.retweet-div').hide();
				if (!status)
				 location.reload();
				else history.go(-1); 
				 
				 

			});
           
		});

		$(document).on('click','.qoute', function(){
			var tweet_id    = $(this).data('tweet');
			var user_id     = $(this).data('user');
			$counter        = $(this).find(".likes-count");
			$count          = $counter.text();
			$button         = $(this);
			
			
			// console.log(tweet_id);
			// console.log($retweeted_it);
			// console.log($sign);
			$.post('core/ajax/retweet.php', {showPopup:tweet_id,user_id:user_id}, function(data){
				$('.popupTweet').html(data);
				 
				$('.close-retweet-popup').click(function(){
					$('.retweet-popup').hide();
				})
			});
		});

	});

	$(document).one('click', '.qoute-it', function(event){
		$('.retweet-popup').addClass('active');
		var tweet_id   = $(this).data('tweet');
		var user_id    = $(this).data('user');
		var flag   = $(this).data('tmp');
		var qoq   = $(this).data('qoq');
		
		event.stopImmediatePropagation();

		// tricky hint each function to select one class only
       var comment ;
		$('.retweet-msg').each(function(){
		comment =	$(this).val()
		});
		
		
		console.log(tweet_id);
		console.log(user_id);
        console.log(comment);
	
	    $.post('core/ajax/retweet.php', {qoute:tweet_id,user_id:user_id,comment:comment,isQoute:flag,qoq:qoq}, function(data){
			
		   $('.retweet-popup').hide();
		   location.reload();
	    	
	    	// $counter.text(data);
	    	// $button.removeClass('retweet').addClass('retweeted');
	    });

	});
});