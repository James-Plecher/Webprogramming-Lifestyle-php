<?php require_once('include/authorise.php'); ?>
<?php require_once('include/functions.php'); ?>

<?php
//from lecture 10, example 6, services.php
    $id = (int) $_GET['id'];
    $service = getService($id);

    // $errors = [];
    // if(isset($_POST['activity'])) {
    //     $email = getLoggedInUser()['email'];

    //     $errors = recordActivity($email, $id, $_POST);
    // }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Living It Full Everyday - MyServices</title>
    <meta name = "description" content = "Helping people learn mental and physical well being practices">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="grid-container-services">
        <?php require_once("include/header.php"); ?>
        <?php require_once("include/navigation.php"); ?>

        <div class="grid-item-services-content">
            <div class="mb-5">
                <h1 class="display-1">
                    <h1 style="color:white;" ><?php echo $service['activity']; ?> <br>
                    <img src="<?php echo $service['icon_path']; ?>" class="service ml-5" /></h1>


                    <!-- all pages found in subsections to make this page tidier, but depeding on what option was chosen on the services.php page, 
                    diffente information will be displayed -->
                    <?php if($id === 1) {
                        require_once('servicePages/yoga_service.php');
                    }
                        else if ($id === 2) { 
                            require_once('servicePages/stretching_service.php');
                    }
                        else if ($id === 3) {
                            require_once('servicePages/meditation_service.php');
                    }
                        else if ($id === 4) {
                            require_once('servicePages/healthy_habits_service.php');
                    }
                    ?>
                </h1>
            </div>

                
        
      </div>
      <?php require_once("include/footer.php"); ?>
</body>
</html>

