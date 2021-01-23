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