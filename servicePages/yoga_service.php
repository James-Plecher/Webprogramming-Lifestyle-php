<?php
    if(isset($_POST['activity'])) {
        if(empty($_POST['duration'])) {
            echo '<div class="alert alert-danger" style="color:white;"><strong>Duration is required.</strong></div>';
            unset($_POST['activity']);
        }
        $act = [
            'email' => getLoggedInUser()['email'],
            'name_of_service' => 'yoga',
            'type_of_service' => $_POST['type'],
            'duration' => $_POST['duration'],
            'day' => date("l")
        ];
        $errors = insertActivity($act);
    }
?>
<p>Select from our yoga classes below and start stiling your mind!</p>

            <?php // The form below is displayed if type has not been submitted. ?>
            <?php if(!isset($_POST['type'])) { ?>
                <?php $serviceInstructions = getServiceInstructions($id); ?>

                <form method="post">
                    <div class="form-group">
                        <?php foreach($serviceInstructions as $serviceInstruction) { ?>
                            <?php $t = $serviceInstruction['service_type']; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                    id="<?php echo $t; ?>" name="type" value="<?php echo $t; ?>" />
                                <label class="form-check-label" for="<?php echo $t; ?>"><?php echo $t; ?></label>
                            </div>
                        <?php } ?>
                        <?php if(isset($_POST['service'])) { ?>
                            <div class='text-danger'>You must select a yoga type.</div>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary mr-5" name="service">Go</button>
                    <a href="services.php" class="btn btn-outline-dark">Back to myServices</a>
                </form>
            <?php } else { ?>
                <!-- very similar to mediation except this is exclusively youtube videos -->
                <?php $serviceInstruction = getServiceInstruction($id, $_POST['type']); ?>

                <h3><?php echo $serviceInstruction['service_type']; ?></h3>
                <?php echo $serviceInstruction['path']; ?>

                <?php if(!isset($_POST['activity'])) { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>" />

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="duration">Duration (minutes)</label>
                                <input type="text" class="form-control d-inline-block" id="duration" name="duration"/>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-5" name="activity">Record Activity</button>
                        <a href="" class="btn btn-outline-dark">Cancel</a>
                    </form>
                <?php } else { ?>
                    <div class="alert alert-success">
                        <h3 style="color:green;"> You have successfully recorded <strong><?php echo $_POST['duration']; ?> minutes</strong> of
                        <strong><?php echo $_POST['type']; ?> Yoga</strong>.</h3>
                    </div>
                    <div>
                        <a href="" class="btn btn-outline-dark mr-5">More </a> <br>
                        <a href="services.php" class="btn btn-outline-dark">Back to myServices</a>
                    </div>
                <?php } ?>
            <?php } ?>

