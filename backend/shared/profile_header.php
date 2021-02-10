<section class="profileHeaderContainer">
           <div class="coverPhotoContainer">
              <img src="<?php echo url_for($profileData->profileCover); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" aria-label="Profile Cover Image" class="cover-photo-user-me">
              <div class="userImageContainer">
                 <img src="<?php echo url_for($profileData->profileImage); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" aria-label="Profile Pic Image" class="profile-pic-me">
              </div>
           </div>
           <div class="profileButtonContainer">
               <?php $loadFromFollow->profileBtn($profileId,$user_id); ?>
              <!-- <button class="edit-profile-btn" role="button">Set up Profile</button> -->
           </div>
           <div class="userDetailsContainer">
              <span class="displayName"><?php echo $profileData->firstName.' '.$profileData->lastName; ?></span>
              <span class="username">@<?php echo $profileData->username; ?></span>
              <span class="description">
                  <svg viewBox="0 0 24 24" class=""><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                  <span class="join">
                    Joined
                  </span>
                  <span class="description__date"><?php echo date("F Y",$date_joined); ?></span>
              </span>
              <div class="followersContainer">
                 <a href="<?php echo url_for($profileData->username.'/following'); ?>">
                    <span class="value count-following">0</span>
                    <span>Following</span>
                 </a>
                 <a href="<?php echo url_for($profileData->username.'/followers'); ?>">
                    <span class="value count-followers">0</span>
                    <span>Followers</span>
                 </a>
              </div>
           </div>
</section>