<?php
require_once("functions.php");?>
<div class="grid-item-1">
    <a href="index.php"><img src="images/life_logo.png" width=100% height=112vh alt="Website Logo. L.I.F.E" class="logo"></a>
    <h1>Living It Full Everyday</h1>

    <?php if(isUserLoggedIn()) { 
        $user = getLoggedInUser(); ?>

        <h1>Welcome, </h1> <h2><?php echo $user['firstName'] ?></h2>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <ul class="header-links">
            <li> <a href="contact_us.php"> Contact Us</a> </li>
            <li><a href="register.php"> Register</a></li>
            <li><a href="login.php"> Log In</a></li>
            <li> <a href="sitemap.php"> Site Map</a> </li>
        </ul>
    <?php } ?>
</div>

