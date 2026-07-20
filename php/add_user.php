<?php
include '../db/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $first = $_POST['first_name'];
    $middle = $_POST['middle_name'];
    $last = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];

    $street = $_POST['street_no'];
    $post = $_POST['post_code'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $national_id = $_POST['national_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $position = $_POST['position'];
    $industry = $_POST['industry'];

    $baseUsername = strtolower(str_replace(' ', '', $first . '.' . $last));
    $username = $baseUsername;
    $count = 1;

    while ($conn->query("SELECT * FROM users WHERE username='$username'")->num_rows > 0) {
        $username = $baseUsername . $count;
        $count++;
    }

    // 2. Insert into address
    $sqlAddress = "INSERT INTO address (street_no, post_code, city, state, country, contact, email)
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtAddress = $conn->prepare($sqlAddress);
    $stmtAddress->bind_param("sssssss", $street_no, $post, $city, $state, $country, $phone, $email);
    $stmtAddress->execute();
    $address_id = $stmtAddress->insert_id;
    $stmtAddress->close();

    // 3. Insert into users
    $sqlUser = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("ss", $username, $password);
    $stmtUser->execute();
    $user_id = $stmtUser->insert_id;
    $stmtUser->close();

    // 4. Insert into owners
    $sqlOwner = "INSERT INTO owners (user_id, address_id, national_id, first_name, middle_name, last_name, dob, gender, nationality, company, job_title, industry)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtOwner = $conn->prepare($sqlOwner);
    $stmtOwner->bind_param("iissssssssss", $user_id, $address_id, $national_id, $first, $middle, $last, $dob, $gender, $nationality, $company, $position, $industry);
    $stmtOwner->execute();
    $stmtOwner->close();

    echo "success";
}


?>