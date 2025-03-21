<!DOCTYPE html>
<html>
<head>
    <title>Living It Full Everyday - Contact Us</title>
    <meta name = "description" content = "Helping people learn mental and physical well being practices">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="grid-container-contact-us">
        <?php require_once("include/header.php"); ?>
        <?php require_once("include/navigation.php"); ?>

        <div class="grid-item-contact-us-content">
            <h1><em>CONTACT US!</em></h1>
            <h3><u>Phone:</u></h3>
            <p>0404 040 004</p>

            <h3><u>Email:</u> </h3>
            <p>LIFE@localcouncil.com</p>

            <h3>Submit a query:</h3>
            <form action="mailto:LIFE@localcouncil.com" method="post" enctype="text/plain">
                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname" maxlength="50" required><br>
                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname" maxlength="50" required><br>
                <label for="phoneNumber">Phone Number:</label><br>
                <input type="tel" id="phoneNumber" name="phoneNumber" required><br>
                <label for="userEmail">Your Email:</label><br>
                <input type="email" id="userEmail" name="userEmail" required><br>
                <label for="userQuery">Your Query:</label><br>
                <input type="text" id="userQuery" name="userQuery" required><br>
                <input type="submit" value="Submit">
              </form>
        </div>
        
        
        <?php require_once("include/footer.php"); ?>
      </div>
</body>
</html>

