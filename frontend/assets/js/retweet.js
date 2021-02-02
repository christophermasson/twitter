$(function(){
    const retweetBtn=document.querySelector(".retweet");
    const retweetModal=document.querySelector(".retweet-container");
    retweetBtn.addEventListener("click",function(e){
        e.preventDefault();
        
        retweetModal.style.display="block";
        
    })
    window.onclick=function(event){
        if(event.target==retweetModal)
        retweetModal.style.display="none";
    }
})