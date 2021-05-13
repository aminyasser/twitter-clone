$(function(){
  var regex = /[#|@](\w+)$/ig;
   
  $(document).on('keyup','.text-whathappen', function(){
    var content = $.trim($(this).val());
    var text = content.match(regex);
    var max = 140;
    
    if(text != null){
      var dataString = 'hashtag='+text;

      $.ajax({
        type: "POST",
        url: "core/ajax/getHashtag.php",
        data: dataString,
        cache: false,
        success: function(data){
          $('.hash-box ul').html(data);
          $('.hash-box li').click(function(){
            var value = $.trim($(this).find('.getValue').text());
            var oldContent = $('.text-whathappen').val();
            var newContent = oldContent.replace(regex, "");
            
             $('.text-whathappen').val(newContent+value+' ');
            $('.hash-box li').hide();
            $('.text-whathappen').focus();

            $('#count').text(max - content.length);
          })
        }
      })

      
    }else{
      $('.hash-box li').hide();
    }

    $('#count').text(max - content.length);
    
    if(content.length >= max){
      $('#count').css('color','#f00');
     
    }else{
      $('#count').css('color','#1DA1F2');
    }
  });
});
