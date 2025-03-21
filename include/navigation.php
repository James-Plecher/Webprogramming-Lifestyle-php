<div class="grid-item-6">
            <ul class="nav-links">
                <li> <a href="index.php"> Home Page</a> </li>
                <li> <a href="yoga.php"> Yoga</a> </li>
                <li><a href="meditation.php"> Meditaion</a></li>
                <li> <a href="stretching.php"> Stretching</a> </li>
                <li> <a href="healthy_habits.php"> Healthy Habits</a> </li>
                <?php if(isUserLoggedIn()) { ?>
                    <li> <a href="services.php"> MyServices </a> </li>
                <?php } else { ?>
                    <li> <a href="login.php"> MyServices </a> </li>
                <?php } ?>
            </ul>
        </div>

