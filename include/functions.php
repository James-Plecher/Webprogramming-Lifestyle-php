<?php
session_start();
const USER_SESSION_KEY = 'user';

function redirect($location) {
    header("Location: $location");
    exit();
}
//created myself from line 9 to 65 without realsing i could use Lecture 10 exapmle 6 functions, would have save me some time :/:/:/
function connectToDatabase() {
    $servername = "rmit.australiaeast.cloudapp.azure.com";
    $user = "s3898959_wp_a2";
    $passwd = "abc123";
    $db = "s3898959_wp_a2";

    $dsn = 'mysql:host=' . $servername . ';dbname=' . $db;

    return new PDO($dsn, $user, $passwd);
}

function isUserLoggedIn() {
    return isset($_SESSION[USER_SESSION_KEY]);
}

function getLoggedInUser() {
    return isUserLoggedIn() ? $_SESSION[USER_SESSION_KEY] : null;
}

function registerUser($formData) {
    $pdo = connectToDatabase();

    $statement = $pdo->prepare(
        'INSERT INTO user_info 
        (firstName, lastName, email, phoneNumber, age, studentStatus, employmentStatus, password) 
        VALUES (:firstname, :lastname, :email, :phone, :age, :student_status, :employment_status, :password)'
    );

    $statement->execute($formData);
    $_SESSION[USER_SESSION_KEY] = $formData;
    redirect('services.php');
}

function loginUser($userNameValue, $passwordValue) {
    $pdo = connectToDatabase();

    $userNameValue = trim($userNameValue);
    $userNameValue = htmlspecialchars($userNameValue);

    $statement = $pdo->prepare('SELECT * FROM user_info WHERE email = :userNameValue');

    $statement->execute(['userNameValue' => $userNameValue]);

    $user = $statement->fetch();

    if ($user !== false && $passwordValue == $user['password']) {
        $_SESSION[USER_SESSION_KEY] = $user;
        return true;
    }

    return false;
}

function logoutUser() {
    session_unset();
}

// --- Utils ----------------------------------------------------------------------------------
//below 3 functions also repurosed for project from lacture 10, example 6
function prepareAndExecute($query, $params = null) {
    $pdo = connectToDatabase();
    $statement = $pdo->prepare($query);
    $statement->execute($params);

    return $statement;
}

function prepareExecuteAndFetchAll($query, $params = null) {
    $statement = prepareAndExecute($query, $params);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function prepareExecuteAndFetch($query, $params = null) {
    $statement = prepareAndExecute($query, $params);

    return $statement->fetch(PDO::FETCH_ASSOC);
}


// --- Services -------------------------------------------------------------------------------
//the below 6 functions were heavily inspired from lec 10, example 6 provided in the lecture
function getServices() {
    return prepareExecuteAndFetchAll('select * from services');
}

function getService($id) {
    return prepareExecuteAndFetch('select * from services where service_id = :id', ['id' => $id]);
}

function getServiceInstructions($id) {
    return prepareExecuteAndFetchAll('select * from service_instruction where service_id = :id', ['id' => $id]);
}

function getServiceInstruction($id, $type) {
    return prepareExecuteAndFetch(
        'select * from service_instruction where service_id = :id and service_type = :type',
        ['id' => $id, 'type' => $type]);
}

function insertActivity($activity) {
    return prepareAndExecute(
        'insert into user_service
        (email, name_of_service, type_of_service, duration, day, date) values
        (:email, :name_of_service, :type_of_service, :duration, :day, now())', $activity);
}

// function insertMeal($s) {
//     return prepareAndExecute(
//         'insert into diet_recommendations
//         (email, diet, reccomendation) values
//         (:email, :diet, :reccomendation', $s);
// }
function insertMeal($s) {
    return prepareAndExecute(
        'INSERT INTO diet_recommendations (email, diet, reccomendation) VALUES (:email, :diet, :reccomendation)',
        $s
    );
}
function recordActivity($email, $serviceID, $form) {
    $errors = [];

    $key = 'duration';
    if(!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1, 'max_range' => 480]]) === false)
        $errors[$key] = 'Duration must be a whole number and not be less than 1 or greater than 480.';
    
    if(count($errors) === 0) {
        // Prepare activity data.
        $activity = [
            'email' => $email,
            'service_id' => $serviceID,
            'service_type' => $form['type'],
            'duration_minutes' => filter_var($form['duration'], FILTER_VALIDATE_INT)
        ];

        // Insert activity into database.
        insertActivity($activity);
    }

    return $errors;
}



//created by me specically for my databases, inspired by provided ones
function getMealsByType($type) {
    return prepareExecuteAndFetchAll('select * from meal where type = :type', ['type' => $type]);
}

function getAllMeals() {
    return prepareExecuteAndFetchAll('select * from meal');
}

function getPlan($email) {
    return prepareExecuteAndFetchAll('select * from diet_recommendations where email = :email', ['email' => $email]);
}

?>