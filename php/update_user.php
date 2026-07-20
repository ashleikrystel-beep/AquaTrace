<?php
include '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_id = $_POST['owner_id'];
    $national_id = $_POST['national_id'];
    $username = $_POST['username'];
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
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $position = $_POST['position'];
    $industry = $_POST['industry'];

    // Get related IDs
    $result = $conn->query("SELECT user_id, address_id FROM owners WHERE owner_id = $owner_id");
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $address_id = $row['address_id'];

    // Update users
    $stmt = $conn->prepare("UPDATE users SET username=?, password=? WHERE user_id=?");
    $stmt->bind_param("ssi", $username, $password, $user_id);
    $stmt->execute();
    $stmt->close();

    // Update address
    $stmt = $conn->prepare("UPDATE address SET street_no=?, post_code=?, city=?, state=?, country=?, contact=?, email=? WHERE address_id=?");
    $stmt->bind_param("sssssssi", $street_no, $post, $city, $state, $country, $phone, $email, $address_id);
    $stmt->execute();
    $stmt->close();

    // Update owners
    $stmt = $conn->prepare("UPDATE owners SET national_id=?, first_name=?, middle_name=?, last_name=?, dob=?, gender=?, nationality=?, company=?, job_title=?, industry=? WHERE owner_id=?");
    $stmt->bind_param("ssssssssssi", $national_id, $first, $middle, $last, $dob, $gender, $nationality, $company, $position, $industry, $owner_id);
    $stmt->execute();
    $stmt->close();

    echo "success";
}
?>