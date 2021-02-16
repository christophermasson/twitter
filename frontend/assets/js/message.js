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


    $(document).on("click",".h-ment",function(){
        var profileId=$(this).data("profileid");
        if(profileId != ""  && profileId != undefined){
            window.location.href="http://localhost/twitter/messages/"+profileId;
        }
    });
   

    
})