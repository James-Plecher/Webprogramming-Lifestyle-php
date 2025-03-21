<?php
require_once("include/functions.php");
$fnameError = "";
$lnameError = "";
$emailError = "";
$emailConfirmError = "";
$phoneError = "";
$studentError = "";
$employmentError = "";
$ageError = "";
$passwordError = "";

$fnameValue = "";
$lnameValue = "";
$emailValue = "";
$emailConfirmValue = "";
$phoneValue = "";
$ageValue = "";
$passwordValue = "";

if(isset($_POST['submit_form'])){
    $fnameValue = $_POST['fname'];
    $lnameValue = $_POST['lname'];
    $emailValue = $_POST['userEmail_1'];
    $emailConfirmValue = $_POST['userEmail_2'];
    $phoneValue = $_POST['phoneNumber'];
    $ageValue = $_POST['age'];
    $passwordValue = $_POST['password'];
    $errorCount = 0;
    
    if(empty($fnameValue)){$fnameError = "First Name is Required!"; $errorCount +=1;
    }
        else{
            $fnameValue = trim($fnameValue);
            $fnameValue = htmlspecialchars($fnameValue);
        }

    if(empty($lnameValue)){$lnameError = "Last Name is Required!";}
    else{
        $lnameValue = trim($lnameValue);
        $lnameValue = htmlspecialchars($lnameValue);
    }
    if(empty($emailValue)){$emailError = "Email is required"; $errorCount +=1;}

    else {
        $emailValue = trim($emailValue);
        $emailValue = htmlspecialchars($emailValue);
        if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z]+\.[A-Za-z.]{2,}$/", $_POST["userEmail_1"])) {  
             $emailError = "<p>Email does not meet format requirments</p>"; 
             $errorCount +=1; 
        }  
        else {
            // $pdoo = new PDO($dsn, $user, $passwd);
            $pdo = connectToDatabase();
            $statement = $pdo->prepare('select * from user_info where email = :emailValue');
            $statement->execute(['emailValue' => $emailValue]);
    
            if ($statement->fetch() !== false) {
                $emailError = "<p>Email already registered</p>";
                $errorCount +=1; 
            }


        }
    }
    if(empty($emailConfirmValue)){$emailConfirmError = "Email is required"; $errorCount +=1;}
    else {
        $emailConfirmValue = trim($emailConfirmValue);
        $emailConfirmValue = htmlspecialchars($emailConfirmValue);
        if($emailConfirmValue !== $emailValue) {
            $emailConfirmError = "<p>Email does not match</p>";  
            $errorCount +=1; 
        }
    }
    if(empty($phoneValue)){$phoneError = "Phone Number is required"; $errorCount +=1; }
    else {
        $phoneValue = trim($phoneValue);
        $phoneValue = htmlspecialchars($phoneValue);
        if(!preg_match("/^\+61\s?4[0-9]{2}\s?[0-9]{3}\s?[0-9]{3}$/", $_POST["phoneNumber"]))  
        {  
             $phoneError = "<p>Phone Number does not meet format requirments</p>";  
             $errorCount +=1; 
        }  
    }
    if($ageValue < 16){$ageError = "<p> You must be 16 or above to register </p>"; $errorCount +=1; }
    if(empty($_POST["student_status"])){$studentError = "<p>Please choose an option</p>"; $errorCount +=1; }  
    if(empty($_POST["employment_status"])){$employmentError = "<p>Please choose an option</p>"; $errorCount +=1; }  

    if(empty($passwordValue)){$passwordError = "Password is Required!"; $errorCount +=1; }
    //NOT WORKING PLEASE COME BACK AND FIXXXGCHGXQJGGHJGHJGHJGHJHJGHJGJGHGHJGHJGJHGHJGJHGJGHJGJHGJHGJHGHJGJHGJHg
    else {
        $passwordValue = trim($passwordValue);
        $passwordValue = htmlspecialchars($passwordValue);
        if(!preg_match("/^(?=.*[-_])[A-Z][a-zA-Z0-9-_]{6,}[0-9]$/", $_POST["password"]))  
        {  
             $passwordError = "<p>Password does not meet requirments</p>";  
             $errorCount +=1; 
        }  
    }
    
    if ($errorCount == 0) {
        $formData = [
            'firstName' => $_POST['fname'],
            'lastName' => $_POST['lname'],
            'email' => $_POST['userEmail_1'],
            'phone' => $_POST['phoneNumber'],
            'age' => $_POST['age'],
            'student_status' => $_POST["student_status"],
            'employment_status' => $_POST["employment_status"],
            'password' => $_POST['password']
        ];
        
        registerUser($formData);
        loginUser($userNameValue, $passwordValue);
    }
    else {
        $fnameValue = isset($_POST['fname']) ? $_POST['fname'] : '';
        $lnameValue = isset($_POST['lname']) ? $_POST['lname'] : '';
        $emailValue = isset($_POST['userEmail_1']) ? $_POST['userEmail_1'] : '';
        $emailConfirmValue = isset($_POST['userEmail_2']) ? $_POST['userEmail_2'] : '';
        $phoneValue = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
        $ageValue = isset($_POST['age']) ? $_POST['age'] : '';
        $studentStatus = isset($_POST['student_status']) ? $_POST['student_status'] : '';
        $employmentStatus = isset($_POST['employment_status']) ? $_POST['employment_status'] : '';
        $passwordValue = isset($_POST['password']) ? $_POST['password'] : '';        
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Living It Full Everyday - Register</title>
    <meta name = "description" content = "Helping people learn mental and physical well being practices">
    <link rel="stylesheet" href="styles.css">
    <!-- <script src="myScript.js"></script> -->
</head>

<body>
    <div class="grid-container-register">
        <?php require_once("include/header.php"); ?>
        <?php require_once("include/navigation.php"); ?>


        <div class="grid-item-register-content">
            <h1>Register Now!</h1>
            <!-- <form name="myForm" onsubmit="return validateForm()"> -->
            <form name="myForm" method="post">

                <label>First name:</label><br>
                <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $fnameValue; ?>"><br>
                <span style = "color: red;" > <?php echo $fnameError ?> </span><br>

                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lnameValue; ?>"><br>
                <span style = "color: red;"> <?php echo $lnameError ?></span><br>

                <label for="userEmail_1">Your Email:</label><br>
                <input type="email" id="userEmail_1" name="userEmail_1" placeholder="email@mail.com" value="<?php echo $emailValue; ?>"><br>
                <span style = "color: red;"> <?php echo $emailError ?></span><br>

                <label for="userEmail_2">Confirm Email:</label><br>
                <input type="email" id="userEmail_2" name="userEmail_2" placeholder="email@mail.com" value="<?php echo $emailConfirmValue; ?>"><br>
                <span style = "color: red;"> <?php echo $emailConfirmError ?></span><br>

                <label for="phoneNumber">Phone Number:</label><br>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="+61 4xx xxx xxx" value="<?php echo $phoneValue; ?>"><br>
                <span style = "color: red;"> <?php echo $phoneError ?></span><br>

                <label for="age">Age (minmum age of 16):</label><br>
                <input type="range" id="age" name="age" min="0" max="120" value="16" oninput="amount.value=age.value" value="<?php echo $ageValue; ?>">
                <output id="amount" name="amount" for="age">16</output>
                <span style = "color: red;" > <?php echo $ageError ?></span><br>
                
                <p>Are you a student?</p>
                <label for="Student"> Student: </label>
                <input type="radio" id="student" name="student_status" value="student" <?php echo ($studentStatus === 'student') ? 'checked' : ''; ?>><br>
                <label for="Student"> Not a student: </label>
                <input type="radio" id="notStudent" name="student_status" value="notStudent" <?php echo ($studentStatus === 'notStudent') ? 'checked' : ''; ?>> <br><br>
                <span style = "color: red;" > <?php echo $studentError ?></span><br>

                <p>Are you employed?</p>
                <label for="Employed"> Employed: </label>
                <input type="radio" id="employed" name="employment_status" value="employed" <?php echo ($employmentStatus === 'employed') ? 'checked' : ''; ?>><br>
                <label for="Unemployed"> Unemployed: </label>
                <input type="radio" id="unemployed" name="employment_status" value="unemployed" <?php echo ($employmentStatus === 'unemployed') ? 'checked' : ''; ?>><br><br>
                <span style = "color: red;" > <?php echo $employmentError ?></span><br>

                <label>Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <span style = "color: red;" > <?php echo $passwordError ?></span><br>

                <!-- <input type="submit" value="Submit"> -->
                <!-- <button inputname='submit_form'>Submit</button> -->
                <input type="submit" name="submit_form" value="Submit">

              </form>
        </div>

        
        <?php require_once("include/footer.php"); ?>
      </div>
      <!-- <script src="myScript.js"></script> -->
</body>
</html>

