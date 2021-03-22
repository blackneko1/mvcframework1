<?php
    require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div> 

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register<h2>
        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <span class="invalidFeedback">
                <?php echo $data['lastnameError'];?>
            </span> 
            <input type="text" placeholder="Last Name *" name="lastname">
            <span class="invalidFeedback">
                <?php echo $data['firstnameError'];?>
            </span>
            <input type="text" placeholder="First Name *" name="firstname">
            <span class="invalidFeedback">
                <?php echo $data['addressError'];?>
            </span>
            <input type="text" placeholder="Address *" name="addresss" >
            <span class="invalidFeedback">
                <?php echo $data['contactError'];?>
            </span>
            <input type="text" placeholder="Contact Number *" name="contact" >
            <span class="invalidFeedback">
                <?php echo $data['emailError'];?>
            </span>
            <input type="text" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['passwordError'];?>
            </span>
            <input type="password" placeholder="Password *" name="passwordd">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError'];?>
            </span>
            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            
            <div class="container">
            <button id="submit" type="submit" value="submit">Register</button> 
            </div>
            <p class="options">Already have account? &nbsp<a href="<?php echo URLROOT;
            ?>/users/login">Sign in.</a></p> 
        </form>
        </div>
    </div>
