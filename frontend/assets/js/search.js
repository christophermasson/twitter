var timer;
$uid=$(".u-p-id").data("uid");
$(function(){
   
    

    $(document).on("keydown",".s-user",function(e){
        // console.log(e);
        clearTimeout(timer);
        var textbox=$(e.target);

       timer=setTimeout(()=>{
        $search=textbox.val().trim();
        if($search !=""){
            // console.log("Contains Data");
            $.post("http://localhost/twitter/backend/ajax/search.php",{search:$search,userId:$uid},function(data){
                //  alert(data);
                $('.s-result-user').html(data);
                // alert(data);
              })
        }else{
            $('.s-result-user').html("");
        }
       },500);
        // alert($uid);
    })
  

    
})