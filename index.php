<?php
 include 'backend/initialize.php';
if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for('home'));
}else if(Login::isLoggedIn()){
    redirect_to(url_for('home'));
}

?>
 <?php require_once 'backend/shared/header.php'; ?>
    <!-- main page -->
    <section class="main-page">
         <!-- left -->
         <div class="left">
             <div class="left-content">
                 <div>
                     <i class="fa fa-search"></i>
                     <h3 class="left-content-heading">Find your interests</h3>
                 </div>
                 <div>
                    <i class="fa fa-user"></i>
                    <h3 class="left-content-heading">Explore what people are talking about</h3>
                </div>
                <div>
                    <i class="fa fa-comment"></i>
                    <h3 class="left-content-heading">Join the people</h3>
                </div>
             </div>
         </div>
         <!-- end of left page -->
         <!-- right -->
         <div class="right">
             <div class="middle-content">
                 <i class="fab fa-twitter"></i>
                 <h1>See what’s happening in the world right now</h1>
                 <h4>Join Twirrer today</h4>
                 <a href="signUp" class="sign-up btn">Sign Up</a>
                 <a href="login" class="log-in btn">Log in</a>
             </div>
         </div>
         <!-- end of right -->
         <!-- Footer -->
         <footer class="main-page-footer" role="contentinfo">
                <ul aria-label="Footer">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Ads info</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Status</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Brand Resources</a></li>
                    <li><a href="#">Advertising</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Advertising</a></li>
                    <li><a href="#">Twitter for Business</a></li>
                    <li><a href="#">Developers</a></li>
                    <li><a href="#">Directory</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#"><small><?php echo date("Y"); ?> Twitter,Inc</small></a></li>
                </ul>  
         </footer>
         <!-- End of Footer -->
    </section>
    <!-- end of main page -->
    
</body>
</html>
        