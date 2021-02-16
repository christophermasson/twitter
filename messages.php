<?php
require_once "backend/shared/main_header_functionality.php";

$pageTitle="Messages / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u-p-id" data-uid="<?php echo $user_id; ?>"></div>
<section class="wrapper">
   <?php  require_once 'backend/shared/nav_header.php'; ?>
   <main role="main">
     <section class="mainSectionContainer">
        <div class="header-top">
           <h4>Messages</h4>
           <a href="<?php echo url_for('messages?q=composeNewMessage'); ?>" class="m-icon-wrapper msg-btn">
           <svg xmlns="http://www.w3.org/2000/svg" class="color-blue" viewBox="0 0 24 24"><g><path d="M23.25 3.25h-2.425V.825c0-.414-.336-.75-.75-.75s-.75.336-.75.75V3.25H16.9c-.414 0-.75.336-.75.75s.336.75.75.75h2.425v2.425c0 .414.336.75.75.75s.75-.336.75-.75V4.75h2.425c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-3.175 6.876c-.414 0-.75.336-.75.75v8.078c0 .414-.337.75-.75.75H4.095c-.412 0-.75-.336-.75-.75V8.298l6.778 4.518c.368.246.79.37 1.213.37.422 0 .844-.124 1.212-.37l4.53-3.013c.336-.223.428-.676.204-1.012-.223-.332-.675-.425-1.012-.2l-4.53 3.014c-.246.162-.563.163-.808 0l-7.586-5.06V5.5c0-.414.337-.75.75-.75h9.094c.414 0 .75-.336.75-.75s-.336-.75-.75-.75H4.096c-1.24 0-2.25 1.01-2.25 2.25v13.455c0 1.24 1.01 2.25 2.25 2.25h14.48c1.24 0 2.25-1.01 2.25-2.25v-8.078c0-.415-.337-.75-.75-.75z"/></g></svg>
          </a>
           
        </div>
        
        
    <?php if(strpos($_SERVER['REQUEST_URI'],'?q=composeNewMessage')): ?>
     <div class="popup-msg-container">
        <div class="popup-msg-wrapper" role="dialog" aria-modal="true" aria-labeeldby="Modal header">
           <div class="popup-msg-header">
               <div class="popup-msg-icon">
                   <svg xmlns="http://www.w3.org/2000/svg" class="color-blue" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" class="mercado-match" width="16" height="16" focusable="false">
                       <path d="M14 3.41L9.41 8 14 12.59 12.59 14 8 9.41 3.41 14 2 12.59 6.59 8 2 3.41 3.41 2 8 6.59 12.59 2z"/>
                    </svg>
               </div>
               <h2 class="popup-msg-modal-header" role="heading" aria-level="2">New Message</h2>
           </div>
           <form action="#" aria-label="Search people" role="search">
               <div class="s-wrapper">
                   <div class="s-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"/></g></svg>
                   </div>
                   <div class="s-bar">
                       <input type="text" aria-label="Search query" placeholder="Search query" role="combox"
                       autocomplete="off" class="s-user">
                   </div>
               </div>
               <div class="s-wrapper-user-container">
                   <ul class="s-result-user">
                        <li role="option" aria-selected="true">
                            <div role="button" tabindex="0" data-focusable="true" class="h-ment">
                                <div class="ment-w-container">
                                <div class="profile-user-icon">
                                    <div class="profile-user-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="p-icon" viewBox="0 0 24 24"><g><path d="M12.225 12.165c-1.356 0-2.872-.15-3.84-1.256-.814-.93-1.077-2.368-.805-4.392.38-2.826 2.116-4.513 4.646-4.513s4.267 1.687 4.646 4.513c.272 2.024.008 3.46-.806 4.392-.97 1.106-2.485 1.255-3.84 1.255zm5.849 9.85H6.376c-.663 0-1.25-.28-1.65-.786-.422-.534-.576-1.27-.41-1.968.834-3.53 4.086-5.997 7.908-5.997s7.074 2.466 7.91 5.997c.164.698.01 1.434-.412 1.967-.4.505-.985.785-1.648.785z"></path></g></svg>
                                    </div>
                                    <div class="f-follow">
                                        Follow
                                    </div>
                                </div>
                                <div class="ment-profile-wrapper">
                                    <div class="ment-profile-pic">
                                        <img src="frontend/profileImage/22/2fbdf53b5e936e25927e6932a.png" alt="Christopher Glikpo">
                                    </div>
                                    <div class="ment-profile-name">
                                        <div class="ment-user-fullName">
                                            <span class="ment-user-fullName-text">Christopher Glikpo</span>
                                        </div>
                                        <div class="ment-user-username">
                                            <span class="ment-user-username-text getValue">@christopherglikpo</span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </li>
                   </ul>
               </div>
           </form>
        </div>
     </div>  
     <?php endif; ?>
     </section>
     <aside role="complementary" class="right-msg">
        <div class="no-msg-container">
            <div class="n-msg-wrapper">
                <h2>You don't have a message selected</h2>
                <p>Choose one from your existing messages or start a new one.</p>
                <a href="<?php echo url_for("messages?q=composeNewMessage") ?>" class="n-msg msg-btn" role="button" data-focusable="true">New message</a>
            </div>
        </div>
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/delete.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/message.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/reply.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/retweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/likeTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/hashtag.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>