<?php
include '../db/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idNumber = $_POST['idNumber'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $middleName = !empty($_POST['middleName']) ? trim($_POST['middleName']) : null;
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $nationality = trim($_POST['nationality']);
    $streetAddress = trim($_POST['streetAddress']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $postalCode = trim($_POST['postalCode']);
    $country = trim($_POST['country']);
    $mobileNumber = trim($_POST['mobileNumber']);

    $alternateNumber = !empty($_POST['alternateNumber']) ? trim($_POST['alternateNumber']) : null;
    $company = !empty($_POST['company']) ? trim($_POST['company']) : null;
    $jobTitle = !empty($_POST['jobTitle']) ? trim($_POST['jobTitle']) : null;
    $industry = !empty($_POST['industry']) ? trim($_POST['industry']) : null;

    // Generate unique username: firstname.lastname
    $baseUsername = strtolower(str_replace(' ', '', $firstName . '.' . $lastName));
    $username = $baseUsername;
    $count = 1;

    while($conn->query("SELECT * FROM users WHERE username='$username'")->num_rows > 0){
        $username = $baseUsername . $count;
        $count++;
    }

    // Hash password
    $hashedPassword = $password;

    // Insert into users table
    $conn->query("INSERT INTO users (username, password, role, created_at) 
                 VALUES ('$username', '$hashedPassword', 'owner', NOW())");
    $user_id = $conn->insert_id;

    // Insert into address table
    $conn->query("
        INSERT INTO address (street_no, post_code, city, state, country, contact, alt_contact, email)
        VALUES (
            '$streetAddress', 
            '$postalCode', 
            '$city', 
            '$state',
            '$country', 
            '$mobileNumber',
            " . ($alternateNumber ? "'$alternateNumber'" : "NULL") . ",
            '$email'
        )
    ");
    $address_id = $conn->insert_id;

    // Insert into owners table
    $conn->query("
        INSERT INTO owners 
        (national_id, first_name, middle_name, last_name, gender, dob, nationality, company, job_title, industry, user_id, address_id)
        VALUES (
            '$idNumber', 
            '$firstName', 
            " . ($middleName ? "'$middleName'" : "NULL") . ", 
            '$lastName',
            '$gender', 
            '$dateOfBirth', 
            '$nationality',
            " . ($company ? "'$company'" : "NULL") . ",
            " . ($jobTitle ? "'$jobTitle'" : "NULL") . ",
            " . ($industry ? "'$industry'" : "NULL") . ",
            '$user_id', 
            '$address_id'
        )
    ");

    header("Location: complete_registration.php?step=3");
    exit();
}
?>