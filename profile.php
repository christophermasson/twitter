<?php
include 'backend/initialize.php';

if(isset($_SESSION['userLoggedIn'])){
   $user_id=$_SESSION['userLoggedIn'];
}else if(Login::isLoggedIn()){
   $user_id=Login::isLoggedIn();
}
$status=$verify->getVerifyStatus(["status"],$user_id);
if(!$status->status=='1'){
   redirect_to(url_for('index'));
}
if(is_get_request()){
    if(isset($_GET['username']) && !empty($_GET['username'])){
       $username=FormSanitizer::formSanitizerString($_GET['username']);
       $profileId=$loadFromUser->userIdByUsername($username);
       if(!$profileId){
        redirect_to(url_for('home'));
       }
    }else{
        $profileId=$user_id;
    }
}
$user=$loadFromUser->userData($user_id);
$profileData=$loadFromUser->userData($profileId);
$date_joined=strtotime($profileData->signUpDate);

$pageTitle=$profileData->firstName.' '.$profileData->lastName.'(@'.$profileData->username.') / Twitter';

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u-p-id" data-uid="<?php echo $user_id; ?>" data-pid="<?php echo $profileId; ?>"></div>
<section class="wrapper">
   <?php  require_once 'backend/shared/nav_header.php'; ?>
   <main role="main">
     <section class="mainSectionContainer">
        <div class="header-top">
          <div class="go-back-arrow" id="go-back-home" aria-label="Back" role="button" data-focusable="true" tabindex="0">
             <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
          </div>
          <div class="header-top-pro">
              <h4><?php echo $profileData->firstName.' '.$profileData->lastName; ?></h4>
              <?php if(!empty($loadFromTweet->tweetCounts($profileId))){ ?>
              <div class="tweet-no"><?php echo $loadFromTweet->tweetCounts($profileId); ?> Tweets</div>
              <?php } ?>
          </div>
        </div>
        <?php require_once 'backend/shared/profile_header.php'; ?>
        <div class="tabsContainer">
          <?php echo $loadFromTweet->createTab('Tweets',url_for($profileData->username),true); ?>
          <?php echo $loadFromTweet->createTab('Tweets & replies',url_for($profileData->username.'/replies'),false); ?>
         
        </div>
        
        <section aria-label="Timeline:Your Profile Timeline" class="profilePostsContainer">
          <?php $loadFromTweet->profileTweet($profileId,10); ?>
        </section>
        <div class="reply-wrapper">
         
        </div>
        <div class="modal-pic" id="modal-pic" style="">
           <div class="artdeco-modal-pic" role="dialog" aria-labelledby="profile-topcard-background-image-header">
              <div class="art-pic-step" aria-modal="true" style="display:none;">
                 <div class="header__topcard">
                    <div class="a-modal-site-logo-wrapper">
                       <i class="fa fa-twitter"></i>
                    </div>
                    <div class="p-btn" id="a-modal-skip">
                       Skip for now
                    </div>
                 </div>
                 <div class="modal-body__topcard">
                    <h3>Pick a profile picture</h3>
                    <p>Have a favorite selfie? Upload it now.</p>
                    <div class="modal-body__topcard-container">
                       <div class="edit-profile__topcard-wrapper">
                          <img src="<?php echo url_for($profileData->profileImage); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>">
                       </div>
                       <div class="topcard-btn-icon">
                          <label for="topcard_filePhoto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                 <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"/>
                                 <path fill="#788fa5" d="M0 10h48v30H0z"/>
                                 <path fill="#fbc2b2" d="M0 15h48v20H0z"/>
                                 <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"/>
                                 <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"/>
                                 <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"/>
                                 <circle cx="24" cy="25" r="2" fill="#fdf9f3"/>
                           </svg>

                          </label>
                          <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_filePhoto">
                       </div>
                    </div>
                 </div>
              </div>
              <div class="art-cov-step" aria-labelledby="modal-header">
                  <div class="header__topcard">
                     <div class="go-back-arrow" aria-label="Back" role="button" data-focusable="true" tabindex="0">
                        <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                     </div>
                     <div class="a-modal-site-logo-wrapper" style="padding-left:0px">
                           <i class="fa fa-twitter"></i>
                        </div>
                        <div class="p-btn" id="a-modal-skip">
                           Skip for now
                        </div>
                      </div><div class="modal-body__topcard-cov">
                     <div class="modal-body__topcard-heading">
                        <h3>Pick a header</h3>
                       <p>People who visit your profile will see it. Show your style.</p>
                     </div>
                     <div class="modal-body__topcard-container-cover">
                        <div class="edit-profile-cov__topcard-wrapper">
                            <img src="<?php echo url_for($profileData->profileCover); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>">
                        </div>
                        <div class="topcard-btn-icon">
                          <label for="topcard_covfilePhoto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                 <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"></path>
                                 <path fill="#788fa5" d="M0 10h48v30H0z"></path>
                                 <path fill="#fbc2b2" d="M0 15h48v20H0z"></path>
                                 <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"></path>
                                 <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"></path>
                                 <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"></path>
                                 <circle cx="24" cy="25" r="2" fill="#fdf9f3"></circle>
                           </svg>

                          </label>
                          <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_covfilePhoto">
                       </div>
                     </div>
                  </div>
              </div>

        </div>
        <div class="d-wrapper-container">
           <div class="d-wrapper">
              <div class="d-content" id="del-content">
                 <div class="d-image">
                    <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                 </div>
                 <span class="d-text" style="color:rgb(224,36,94);">
                    Delete
                 </span>
              </div>
              <div class="d-content" id="pin-content">
                 <div class="d-image">
                 <svg viewBox="0 0 24 24" class="pin-icon"><g><path d="M20.472 14.738c-.388-1.808-2.24-3.517-3.908-4.246l-.474-4.307 1.344-2.016c.258-.387.28-.88.062-1.286-.218-.406-.64-.66-1.102-.66H7.54c-.46 0-.884.254-1.1.66-.22.407-.197.9.06 1.284l1.35 2.025-.42 4.3c-1.667.732-3.515 2.44-3.896 4.222-.066.267-.043.672.222 1.01.14.178.46.474 1.06.474h3.858l2.638 6.1c.12.273.39.45.688.45s.57-.177.688-.45l2.638-6.1h3.86c.6 0 .92-.297 1.058-.474.265-.34.288-.745.228-.988zM12 20.11l-1.692-3.912h3.384L12 20.11zm-6.896-5.413c.456-1.166 1.904-2.506 3.265-2.96l.46-.153.566-5.777-1.39-2.082h7.922l-1.39 2.08.637 5.78.456.153c1.355.45 2.796 1.78 3.264 2.96H5.104z"></path></g></svg>
                 </div>
                 <span class="d-text">
                    Pin to your profile
                 </span>
              </div>
           </div>
        </div>
        <div class="del-post-wrapper-container">
           <div class="del-post-wrapper">
              <div class="del-post-content">
                 <h2 class="del-post-content-header">Delete Tweet?</h2>
                 <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow you, and from Twitter search results.</p>
                 <div class="del-btn-wrapper">
                    <button class="del-btn" id="cancel" type="button">Cancel</button>
                    <button class="del-btn" id="delete-post-btn" type="button">Delete</button>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/delete.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/reply.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/retweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/likeTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/hashtag.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>