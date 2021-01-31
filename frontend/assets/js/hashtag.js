const modalHash=document.querySelector(".hash-box-wrapper");

$(window).on("click",function(e){
    if(e.target==modalHash){
        modalHash.style.display="none";
    }
})

$("#postTextarea").keyup(e=>{
  let regex=/[#|@](\w+)$/ig;
  let textbox=$(e.target);
  let content=textbox.val().trim();
  let max=200;
  let text=content.match(regex);
  if(text != null && text != ""){
    var dataString='hashtag='+text;
    $.ajax({
      type:"POST",
      data:dataString,
      url:"http://localhost/twitter/backend/ajax/getHashtag.php",
      cache:false,
      success:function(data){
        modalHash.style.display="block";
        $(".hash-box ul").html(data);
      }
    })
  }else{
    modalHash.style.display="none";
  }
})