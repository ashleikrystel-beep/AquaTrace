<?php
include '../db/database.php';

if (isset($_POST['owner_id'])) {
    $id = $_POST['owner_id'];

    $sql = "UPDATE owners SET is_archived = 1 WHERE owner_id = ?";
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