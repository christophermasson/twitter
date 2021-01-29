$(function(){
    let uid=$(".u-p-id").data("uid");
    let win=$(window);
    let offset=10;
    
    win.scroll(function(){
        let content_height=$(document).height();
        let content_y=win.height()+win.scrollTop();
        // console.log(content_y + "/"+content_height);
        if(content_height <= content_y){
            // offset =offset +10;
            offset +=10;
            $.post('http://localhost/twitter/backend/ajax/fetchTweet.php',{fetchTweets:offset,userId:uid},function(data){
                $(".postContainer").html(data);
            })
        }
    })
})