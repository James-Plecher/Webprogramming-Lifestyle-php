<?php
//stretching is set up different to the other 3 services
//it first asks for the type of stretch performed, which could have any name. 
//then if that stettch has a few key words, it finds it in the database and plays a relevent video to that stretch
//otherwise, it plays the defualt fullbody stretching video
    if(isset($_POST['activity']) && !empty($_POST['stretch_move']) && !empty($_POST['duration'])) {
        $act = [
            'email' => getLoggedInUser()['email'],
            'name_of_service' => 'stretching',
            'type_of_service' => $_POST['stretch_move'],
            'duration' => $_POST['duration'],
            'day' => date("l")
        ];
        $errors = insertActivity($act);
    }
?>
<p>Stretching:</p>

            <?php // Asks for a quick, normal or extended stretching session, plays relevant video tutorial, then asks for amount of time you spent stretching ?>
            <?php if(empty($_POST['stretch_move']) || empty($_POST['duration'])) { ?>
                <?php $serviceInstructions = getServiceInstructions($id); ?>

                <form method="post">
                    <div class="form-group">
                        <label for="stretch_move">Stretching Move:</label>
                        <input type="text" id="stretch_move" name="stretch_move">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration (minutes):</label>
                        <input type="number" id="duration" name="duration" min="1">
                    </div>
                    <button type="submit" name="activity" id="activity">Submit</button>
                    <a href="services.php" class="btn btn-outline-dark">Back to myServices</a>

                </form>
                <?php } 
                else { 
                    //on this second page is where the video is displayed
                    //id is defined in myServices.php
                    $serviceInstructions = getServiceInstructions($id);
                    $stretch_move = $_POST['stretch_move'];
                    $match = false;
                    $default = getServiceInstruction($id, 'fullbody');

                    //echos out the records in the database which have embedded youtube videos 
                    foreach ($serviceInstructions as $serviceInstruction) {
                        $t = $serviceInstruction['service_type'];
                        if (strpos($stretch_move, $t) !== false) {
                            echo "<h3>{$serviceInstruction['service_type']}</h3>";
                            echo "<p>{$serviceInstruction['path']}</p>";
                            $match = true;
                        }
                    }
                    
                    if ($match == false){
                        echo "<h3>{$default['service_type']}</h3>";
                        echo "<p>{$default['path']}</p>";
                    } ?> 
                    
                    <a href="myServices.php?id=2" class="btn btn-outline-dark">Enter another Stretch</a><br>
                    <a href="services.php" class="btn btn-outline-dark">Back to myServices</a>
                    <?php
                    
                }?>

            
                       
                
                   

