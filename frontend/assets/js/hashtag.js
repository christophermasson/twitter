const modalHash=document.querySelector(".hash-box-wrapper");

$(window).on("click",function(e){
    if(e.target==modalHash){
        modalHash.style.display="none";
    }
})