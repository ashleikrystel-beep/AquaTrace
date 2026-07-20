<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $port_id = $_POST['port_id'] ?? '';

    if (!$port_id) {
        echo json_encode(["status" => "error", "message" => "Port ID is required"]);
        exit;
    }

    // Update port to archived
    $stmt = $conn->prepare("UPDATE ports SET is_archived = 1 WHERE port_id = ?");
    $stmt->bind_param("i", $port_id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Port archived successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to archive port: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>