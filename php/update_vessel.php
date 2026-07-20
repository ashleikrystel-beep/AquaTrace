<?php
include '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['vessel_id'];
    $name = $_POST['name'];
    $imo = $_POST['imo'];
    $mmsi = $_POST['mmsi'];
    $call_sign = $_POST['call_sign'];
    $type = $_POST['type'];
    $flag = $_POST['flag'];
    $LoA = $_POST['LoA'];
    $gross_tonnage = $_POST['gross_tonnage'];
    $year_built = $_POST['year_built'];

    $sql = "UPDATE vessels 
            SET name=?, imo=?, mmsi=?, call_sign=?, type=?, flag=?, LoA=?, gross_tonnage=?, year_built=?
            WHERE vessel_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssddi", 
            $name, $imo, $mmsi, $call_sign, $type, $flag, $LoA, $gross_tonnage, $year_built, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>