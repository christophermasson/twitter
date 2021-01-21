<?php 
include_once "backend/initialize.php";
include_once "backend/shared/register_handlers.php";

$pageTitle="SignUp | Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="sign-container">
      <?php require_once 'backend/shared/loginNav.php'; ?>
       <div class="form-container">
         <div class="form-content">
          <div class="header__form-content">
              <h2>Create your account</h2>
           </div>
           <form  class="formField" action="<?php echo h($_SERVER["PHP_SELF"]);?>" method="POST">
             <div class="form-group">
                 <?php echo $account->getError(Constant::$firstNameCharacters); ?>
                  <label for="firstName">First name</label>
                  <input type="text" name="firstName" id="firstName" value="<?php getInputValue('firstName'); ?>" autocomplete="off" required>    
             </div>
             <div class="form-group">
                <?php echo $account->getError(Constant::$lastNameCharacters); ?>
                  <label for="lastName">Last name</label>
                  <input type="text" name="lastName" id="lastName" value="<?php getInputValue('lastName'); ?>"   autocomplete="off" required>
             </div>
             <div class="form-group">
              <?php echo $account->getError(Constant::$emailTaken); ?>
              <?php echo $account->getError(Constant::$emailInvalid); ?>
                  <label for="email">Email</label>
                  <input type="email"  name="email"  id="email" value="<?php getInputValue('email'); ?>"   autocomplete="off" required>
             </div>
             <div class="form-group">
               <?php echo $account->getError(Constant::$passwordsDoNotMatch); ?>
               <?php echo $account->getError(Constant::$passwordTooShort); ?>
               <?php echo $account->getError(Constant::$passwordNotAlphaNumeric); ?>
                   <label for="password">Password</label>
                   <input type="password" name="password" id="password" autocomplete="off" required>
             </div>
             <div class="form-group">
                 <label for="password2">Confirm Password</label>
                 <input type="password"  name="password2" id="password2" autocomple="off" required>
             </div>
             <div class="s-password">
               <input type="checkbox" class="form-checkbox" id="s-password" onclick="showPassword()">
               <label for="s-password">Show Password</label>
             </div>
             <div class="form-btn-wrapper">
               <button type="submit" class="btn-form">Signup</button>
               <input type="checkbox" class="form-checkbox" id="check" name="remember">
               <label for="check">Remember me</label>
             </div>
           </form>
         </div>
         <footer class="form-footer">
           <p>Already have  an account? <a href="login">Login now</a></p>
         </footer>
       </div>
    </section>

  
  
  <script src="frontend/assets/js/showPassword.js"></script>
</body>
</html>