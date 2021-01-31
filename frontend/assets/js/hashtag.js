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
        $(".hash-box li").click(function(){
          let value=$.trim($(this).find('.getValue').text());
          let oldContent=$("#postTextarea").val();
          let newContent=oldContent.replace(regex,"");
          $("#postTextarea").val(newContent+value+' ');
          modalHash.style.display="none";
          $("#postTextarea").focus();
          $("#count").text(max-content.length);
        })
      }
    })
  }else{
    modalHash.style.display="none";
  }
  
  $("#count").text(max-content.length);
  if(content.length >= max){
    $("#count").css("color","#f00");
  }else{
    $("#count").css("color","#000");
  }

})