<?php require_once('include/authorise.php'); ?>
<?php require_once('include/functions.php'); ?>
<?php $services = getServices(); ?>

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
            <!-- reads all the services from the database that have been enetered and displays the link and image on teh screen
        they all redirect to the myServices.php page but sets a specific id to show specific information depending on option chosen -->
        <?php foreach($services as $service) { ?>
                <div class="col-3-text-center">
                    <a href="myServices.php?id=<?php echo $service['service_id']; ?>">
                        <img src="<?php echo $service['icon_path']; ?>" class="service"/>
                        <h3 class="service"><?php echo $service['activity']; ?></h3>
                    </a>
                </div>
            <?php } ?>

        </div>
        
        <?php require_once("include/footer.php"); ?>
      </div>
</body>
</html>

