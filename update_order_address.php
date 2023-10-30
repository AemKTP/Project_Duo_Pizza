<?php
include "dbconn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $newAddress = $_POST['newAddress'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $address = $name . ', ' . $newAddress . ', phone: ' . $phone;

    
    $updateAddress = $conn->prepare("UPDATE `order` SET adress = ? WHERE uid = ?");
    $updateAddress->bind_param("si", $address, $uid);
    $updateAddress->execute();

    
    header("Location: order.php?uid=" . $uid);
}
?>
