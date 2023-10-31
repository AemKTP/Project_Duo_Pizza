<?php
include "dbconn.php";


$selectstmt = $conn->prepare("select round from `order` where uid = ?");
$selectstmt->bind_param("i", $useruid);
$selectstmt->execute();
$resultselectstmt = $selectstmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $newAddress = $_POST['newAddress'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $address = $name . ', ' . $newAddress . ', phone: ' . $phone;

    $round = 1;
    while ($rowrslstmt = $resultselectstmt->fetch_assoc()) {


        if ($rowrslstmt['round'] && $rowrslstmt['round'] >= $round) {
            $round = $rowrslstmt['round'] + 1;
        }
    }
    $updateAddress = $conn->prepare("UPDATE `order` SET adress = ? WHERE uid = ? and round = ?");
    $updateAddress->bind_param("sii", $address, $uid, $round);
    $updateAddress->execute();

    // $method = "new"; // ค่าที่ต้องการส่งไปหน้าอื่น
    // header("Location: order.php?uid=$uid&new_address=$method");
    header("Location: order.php?uid=$uid");

} ?>
