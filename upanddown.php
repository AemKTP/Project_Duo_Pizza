<?php
include "dbconn.php";
$uid = $_GET['uid'];
$cartid = intval($_POST['cartid']);
$process = intval($_POST['process']);

$stmt = $conn->prepare("SELECT price, amount FROM cart WHERE cartid = ?");
$stmt->bind_param("i", $cartid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$priceperamount = $row['price'] / $row['amount'];

if ($process == 1) {
    // เพิ่มจำนวน
    $newAmount = $row['amount'] + 1;
    $newPrice = $priceperamount * $newAmount;

    $updateStmt = $conn->prepare("UPDATE cart SET amount=?, price=? WHERE cartid = ?");
    $updateStmt->bind_param("idi", $newAmount, $newPrice, $cartid);
    if ($updateStmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }

    header("location:cart.php?uid=" . $uid);
} elseif ($process == -1 && $row['amount'] > 1) {
    // ลดจำนวน (เฉพาะเมื่อจำนวนมากกว่า 1)
    $newAmount = $row['amount'] - 1;
    $newPrice = $priceperamount * $newAmount;

    $updateStmt = $conn->prepare("UPDATE cart SET amount=?, price=? WHERE cartid = ?");
    $updateStmt->bind_param("idi", $newAmount, $newPrice, $cartid);
    if ($updateStmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }

    header("location:cart.php?uid=" . $uid);
} else {
    echo "ไม่สามารถลดจำนวนได้";
}
?>
