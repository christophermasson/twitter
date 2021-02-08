let uid=$(".u-p-id").data("uid");

$(function(){
   
    let path=window.location.href;
    $('#nav a').each(function(){
        if(this.href===path){
            $(this).addClass('active');
        }
    })
});


const btn=document.querySelector(".w-header-container");
const modal=document.querySelector("#myLogoutModal");

$(document).on("click",".w-header-container",function(){
        
    modal.style.display="block";
})

$(window).on("click",function(e){
    if(e.target==modal){
        modal.style.display="none";
    }
})

$(document).on("keyup","#postTextarea,#replyInput",function(e){
    e.preventDefault();
    let textbox=$(e.target);
    let value=textbox.val().trim();
    let isReplyModal=textbox.parents(".reply-wrapper").length==1;

    let submitButton=isReplyModal ? $("#replyBtn") : $("#submitPostButton"); 
    // let submitButton=$("#submitPostButton");

    if(value == ""){
        submitButton.prop("disabled",true);
        return;
    }else if(value.length >= 200){
        submitButton.prop("disabled",true);
        return;
    }
    
    submitButton.prop("disabled",false);

});

$("#submitPostButton").click(e=>{
    e.preventDefault();
    let submitButton=$("#submitPostButton");
    let textValue=$("#postTextarea").val();
    let userid=uid;
    let max=200;
    
    if(textValue != "" && textValue != null){
        $.post("http://localhost/twitter/backend/ajax/post.php",{onlyStatusText:textValue,userid:userid},function(data){
            $(".postContainer").html(data);
            $("#postTextarea").val("");
            $("#count").text(max);
            submitButton.prop("disabled",true);
        })
    }
    
})

$(document).on("click","#go-back-home",function(e){
    e.preventDefault();
    window.location.href="http://localhost/twitter/home";
})