
<?php
//this was taken and purposed for my project from lecture 10, example 6 material 
//used so not logged in users cant enter the services

require_once('functions.php');

if(!isUserLoggedIn())
    redirect('login.php');
    ?>
