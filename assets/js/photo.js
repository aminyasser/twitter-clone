$(function(){
	
	$glo = this;
	$(document).on('change','#file-input', function(e){
		 
         if (this.files && this.files[0]) {
             let reader = new FileReader();
             reader.onload=function(e){
                 let image = document.querySelector("#preview-user");
                 image.src = e.target.result;
             }
             reader.readAsDataURL(this.files[0]);
         }
        
    });

    $(document).on('change','#cover-input', function(e){
		 
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload=function(e){
                let image = document.querySelector("#preview-cover");
                image.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
       
   });

   $(document).on('change','#tweet_img', function(e){
		 console.log(this);
        $glo = this;
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        reader.onload=function(e){ 
           let container =  document.querySelector(".upload-photo");
           container.style.display = "block";
            let image = document.querySelector(".img-upload-tmp");
            image.src = e.target.result;
        }
        // alert("all right");
        reader.readAsDataURL(this.files[0]);
        this.files = null;
    } 
   
   
   });

   $(document).on('click','.upload-delete', function(e){
		 
           let container =  document.querySelector(".upload-photo");
           container.style.display = "none";
            let control =$("#tweet_img");
            control.val("");  
   });
});