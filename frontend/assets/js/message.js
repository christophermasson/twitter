var timer;
$(function(){
    // let uid=$(".u-p-id").data("uid");
    var modal=document.querySelector(".popup-msg-container");
    

    $(document).on("click",".msg-btn",function(){
        modal.style.display="block";
    });

    $(document).on("click",".popup-msg-icon",function(){
        modal.style.display="none";
    });

    $(window).on("click",function(e){
        if(e.target==modal){
            modal.style.display="none";
        }
    });

    $(document).on("keydown",".s-user",function(e){
        // console.log(e);
    })
  

    
})