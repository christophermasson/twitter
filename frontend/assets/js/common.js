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
btn.addEventListener("click",function(e){
    e.preventDefault();
    
    modal.style.display="block";
    
})
window.onclick=function(event){
    if(event.target==modal)
    modal.style.display="none";
}

$(document).on("keyup","#postTextarea",function(e){
    e.preventDefault();
    let textbox=$(e.target);
    let value=textbox.val().trim();
    let submitButton=$("#submitPostButton");

    if(value == ""){
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
    
    if(textValue != "" && textValue != null){
        $.post("http://localhost/twitter/backend/ajax/post.php",{onlyStatusText:textValue,userid:userid},function(data){
            $(".postContainer").html(data);
            $("#postTextarea").val("");
            submitButton.prop("disabled",true);
        })
    }
    
})