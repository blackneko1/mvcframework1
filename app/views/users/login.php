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
        <h2>Sign in<h2>
        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <input type="text" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError'];?>
            </span>   
            <input type="password" placeholder="Password *" name="passwordd">
            <span class="invalidFeedback">
                <?php echo $data['passwordError'];?>
            </span>
            <div class="container">
            <button id="submit" type="submit" value="submit">Login</button> 
            </div>
            <p class="options">Not Registered yet? &nbsp<a href="<?php echo URLROOT;
            ?>/users/register">Create an account.</a></p> 
        </form>
        </div>
    </div>
