<?php
//THIS page isnt very well implemented, due to my lack of planning around time :/ 
//I would like to expand on it more so the idea is you select your diet type, calories target and amount of meals and that serves
//a "goal" and that form doesnt show up again unless u go specifically to it to edit it. 
//right now it shows up every time the page is loaded and you cant delete any record you put in the database so it just makes it a 
//list of food items displayed a the bottom of the screen, it was an attempt but i got stuck, spent over 2 hours solving the $Session[diet] issue
$recommendation = '';
//keeps diet between sessions on form submissions
if(isset($_POST['diet'])) {
    $_SESSION['diet'] = $_POST['diet'];
}

//submits to database - diet_recomndations
if(isset($_POST['generate'])) {
    $act = [
        'email' => getLoggedInUser()['email'],
        'diet' => $_SESSION['diet'],
        'reccomendation' => $_POST['type']
    ];
    $errors = insertMeal($act);
    
}

?>
<?php //a form for 
    if(!isset($_POST['diet']) || !isset($_POST['AOM']) || !isset($_POST['kilojoules'])) { ?>
    <form method="post">
            <h4>Diet Goals each Day:</h4>
            <label for="anything"><input type="radio" id="anything" name="diet" value="anything">Anything</label>
            <label for="vegetarian"><input type="radio" id="vegetarian" name="diet" value="vegetarian">Vegetarian</label>
            <label for="vegan"><input type="radio" id="vegan" name="diet" value="vegan">Vegan</label>
            <label for="keto"><input type="radio" id="keto" name="diet" value="keto">Ketogenic</label>
            <label for="paleo"><input type="radio" id="paleo" name="diet" value="paleo">Paleo</label><br><br>

            <label for="kilojoules">Daily Kilojoules Intake:</label>
            <input type="number" id="kilojoules" name="kilojoules"><br><br>

            <label for="AOM">Amount of meals: </label>
            <label for="one"><input type="radio" id="one" name="AOM" value="one">One</label>
            <label for="two"><input type="radio" id="two" name="AOM" value="two">Two</label>
            <label for="three"><input type="radio" id="three" name="AOM" value="three">Three</label>
            <label for="four"><input type="radio" id="four" name="AOM" value="four">Four</label>
            <label for="five"><input type="radio" id="five" name="AOM" value="five">Five</label><br><br>

            <br><br><button type="submit" name="Submit_Diet">Submit </button>
    </form>

<?php }
    else { ?>

        <?php //after form is submited this page appears without redirecting
         $diet = $_POST['diet']; ?>
        <h1> <?php echo $_POST['diet'];?> Diet </h1> <br>
        <h1> Amount of Meals Goal: <?php echo $_POST['AOM'];?> </h1> <br>
        <h1> Amount of Kilojoules Goal: <?php echo $_POST['kilojoules'];?> </h1>

        
        <?php if ($_POST['diet'] == "anything") {
            $meals = getAllMeals(); 
        }
        else {
            $meals = getMealsByType($_POST['diet']);
        }
        
        ?>
        <form method="post">
            <?php foreach($meals as $meal) { ?>
            <?php $t = $meal['name']; ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="<?php echo $t; ?>" name="type" value="<?php echo $t; ?>" />
                <label class="form-check-label" for="<?php echo $t; ?>"><?php echo $t; ?></label>
            </div>
        <?php } ?> 

        <button type="submit" class="btn btn-primary mr-5" name="generate">Generate</button>
        <a href="services.php" class="btn btn-outline-dark">Back to myServices</a>
        </form>
    
                    <!-- shows all the food items user has added to their meal history that is in the database -->
        <h1> CURRENT MEAL PLAN: </h1> 
        <?php $tets = getPlan(getLoggedInUser()['email']);
        foreach($tets as $tet) { ?>
            <?php $t = $tet['reccomendation'];
            echo $t; ?> <br>
        <?php } 
        ?> 
        
    <?php } ?>



