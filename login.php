<?php
//i dont know why the header and nav bar scale differently onlt for the login page
require_once("include/functions.php");

$userNameError = "";
$userNameValue = "";
$passwordError = "";
$passwordValue = "";
$submitError = "";

if(isset($_POST['submit_login'])){
    $userNameValue = $_POST['username'];
    $passwordValue = $_POST['password'];
    
    $errorCount = 0;
    
    if(empty($userNameValue)){$userNameError = "Username is Required!"; $errorCount +=1;}
    else{
        //trim and special chars for protection of website and server
        $userNameValue = trim($userNameValue);
        $userNameValue = htmlspecialchars($userNameValue);
    }
    
    if(empty($passwordValue)){$passwordError = "Password is Required!"; $errorCount +=1;}
    else{
        $passwordValue = trim($passwordValue);
        $passwordValue = htmlspecialchars($passwordValue);
    }

    if($errorCount == 0) {
        if (loginUser($userNameValue, $passwordValue)) {
            // Successful login goes to servies page
            redirect('services.php');
        } else {
            $submitError = 'Login failed, email and/or password incorrect. Please try again.';
        }
    }
}
?>

<html>
<head>
    <title>Living It Full Everyday - Login</title>
    <meta name = "description" content = "Helping people learn mental and physical well being practices">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="grid-container-register">
        <?php require_once("include/header.php"); ?>
        <?php require_once("include/navigation.php"); ?>


        <div class="grid-item-register-content">
            <h1>Login:</h1>
                <form name="myForm" method="post">

                <label>Username:</label><br>
                <input type="text" id="username" name="username" placeholder="Email"><br>
                <span style = "color: red;" > <?php echo $userNameError ?> </span><br>

                <label>Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <span style = "color: red;" > <?php echo $passwordError ?> </span><br>

                <input type="submit" name="submit_login" value="Submit"> <br>
                <span style = "color: red;" > <?php echo $submitError ?> </span><br>

              </form>
              
        </div>

        
        <?php require_once("include/footer.php"); ?>
      </div>
</body>
</html>

