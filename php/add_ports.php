<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $port_name = $_POST['port_name'] ?? '';
    $city = $_POST['city'] ?? '';
    $province = $_POST['province'] ?? '';

    if (!$port_name || !$city || !$province) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    // Insert into address table first
    $stmt = $conn->prepare("INSERT INTO address (city, state) VALUES (?, ?)");
    $stmt->bind_param("ss", $city, $province);

    if ($stmt->execute()) {
        $address_id = $stmt->insert_id;

        // Insert into ports table
        $stmt2 = $conn->prepare("INSERT INTO ports (name, address_id) VALUES (?, ?)");
        $stmt2->bind_param("si", $port_name, $address_id);

        if ($stmt2->execute()) {
            $port_id = $stmt2->insert_id;
            echo json_encode([
                "status" => "success", 
                "message" => "Port added successfully",
                "port_id" => $port_id
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add port: " . $stmt2->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add address: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>