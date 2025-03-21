<!DOCTYPE html>
<html>
<head>
    <title>Living It Full Everyday</title>
    <meta name = "description" content = "Helping people learn mental and physical well being practices">
    <link rel="stylesheet" href="styles.css">
    <!-- THIS IS JQUERY WIDGET info in head -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- script for the widget -->
    <script>
    $( function() {
        $( "#accordion" ).accordion();
    } );
    </script>
</head>

<body>
    <div class="grid-container">
        <?php require_once("include/header.php"); ?>
        <?php require_once("include/navigation.php"); ?>

        <div class="grid-item-3">
            <h3>Meaning of L.I.F.E?</h3>
            <p>
                Welcome to our website, a dedicated space designed to support individuals navigating the aftermath of the COVID-19 pandemic. While the pandemic itself may be officially over, its lasting impact on our lives persists. We understand that many are still grappling with the emotional repercussions and challenges posed by this unprecedented global event. According to a comprehensive report by the Australian Institute of Health and Welfare, stress, confusion, and anger remain prevalent post-pandemic, contributing to the potential for long-term mental health challenges, including anxiety and depression. Recognizing the ongoing need for support, our website is committed to providing resources and practices aimed at fostering mental and emotional well-being. 
            </p>
            <p>
                Our primary goal is to offer a holistic approach to mental health recovery by promoting activities that have proven benefits in alleviating stress and improving overall well-being. Through the incorporation of practices such as yoga, meditation, stretching, and the cultivation of healthy habits, we aim to empower individuals on their journey towards emotional resilience. Whether you are seeking solace from lingering anxiety or looking to establish a foundation for long-term mental wellness, our platform is here to guide you. Together, we can navigate the path towards healing and create a supportive community that understands the unique challenges posed by Covid-19 and help eachother navigate this landscape together.
            </p>
            <!-- this accordtion div contains the dropdown like list conatinging a bit of information about each service provided -->
            <div id="accordion">
                <h3>Yoga</h3>
                <div>
                    <p>
                    Watch videos on how to get started in the world of yoga and become a more centered and balanced individual!
                    </p>
                </div>
                <h3>Stretching</h3>
                <div>
                    <p>
                    Review the stretching charts provided in our services for great starts and progress tracking in becoming incredibly flexible!
                    </p>
                </div>
                <h3>Meditation</h3>
                <div>
                    <p>
                    Gain more peace of mind and sense of self by meditating and listeing to these 3 peaceful auido tunes.
                    </p>
                    <ul>
                    <li>Silent Hill: By Adam Burke</li>
                    <li>Deep sleep music: By Yellow Brick Cinema</li>
                    <li>Relaxing Zen: By Paul Landry</li>
                    </ul>
                </div>
                <h3>Healthy Habits</h3>
                <div>
                    <p>
                    Read up and keep up to date with all the latest findings on how to eat, sleep, and move healitly with all the latest findings being posted to keep you as full of life as possible!
                </div>
            </div>
        </div>

        <!-- link to A1 stuff, not needed for A2 -->
        <div class="grid-item-2">
            <div class="container">
                <h2>Wellbeing for Beginners!</h2>
                <p>Choose an option below to start learning to live L.I.F.E to the full!</p>
                <a href="yoga.php"> <img src="images/yoga.jpeg" width=500px height=350px alt="A young woman perfroming yoga on a purple mat" class="top-left-image"></a>
                <a href="meditation.php"> <img src="images/meditation.jpeg" width=500px height=350px alt="A woman sitting crossed legged on the floor in a forest meditating" class="top-right-image"></a>
                <a href="stretching.php"> <img src="images/strecthing.webp" width=500px height=350px alt="A middle aged man sitting on the road in excercise outfit streching his right leg" class="bottom-left-image"></a>
                <a href="healthy_habits.php"> <img src="images/habits.png" width=500px height=350px alt="A cutting board with a cucumber being sliced" class="bottom-right-image"></a>
            </div>
        </div>
        
    <?php require_once("include/footer.php"); ?>
  </div>
</body>
</html>

