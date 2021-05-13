$(function(){
	
    // the function pass the post var without form to search.php
	$('.search-input').keyup(function(){
		var search = $(this).val();
		$.post('core/ajax/search.php', {search:search}, function(data){
			$('.search-result').html(data);
			if(search == ""){
				$('.search-result').html("");
				$('.search-result li').click(function(){
					$('.search-result li').hide();
				});	
			}
		});
    });
    



});