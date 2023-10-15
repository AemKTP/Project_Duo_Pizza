<?php
include "dbconn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $newAddress = $_POST['newAddress'];

    
    $updateAddress = $conn->prepare("UPDATE `order` SET adress = ? WHERE uid = ?");
    $updateAddress->bind_param("si", $newAddress, $uid );
    $updateAddress->execute();

    
    header("Location: order.php?uid=" . $uid);
}
?>
