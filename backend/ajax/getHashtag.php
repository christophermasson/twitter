<?php

require_once "../initialize.php";



if(is_post_request()){
    if(isset($_POST['hashtag']) && !empty($_POST['hashtag'])){
        $hashtag=FormSanitizer::formSanitizerString($_POST['hashtag']);
        
        if(substr($hashtag,0,1)==='#'){
            $trend=str_replace('#','',$hashtag);
            $trends=$loadFromTweet->getTrendByHash($trend);
            foreach($trends as $hashtag){
                 echo '<li role="option" aria-selected="true">
                 <div role="button" tabindex="0" data-focusable="true" class="getValue h-ment">#'.$hashtag->hashtag.'</div>
                </li>';
            }

        }

        
    }
}