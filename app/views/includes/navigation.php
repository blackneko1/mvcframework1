<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/about">About Us</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/service">Services</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/FAQ">FAQ</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/contact">Contact</a>
        </li>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>
            <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            <?php else : ?> 
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>