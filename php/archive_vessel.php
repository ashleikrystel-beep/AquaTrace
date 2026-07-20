<?php
include '../db/database.php';

if (isset($_POST['vessel_id'])) {
    $id = $_POST['vessel_id'];

    $sql = "UPDATE vessels SET is_archived = 1 WHERE vessel_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("i", $id);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $query->close();
    $conn->close();
}
?>