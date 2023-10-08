<?php

include "dbconn.php";



$cartid = $_POST['cartid'];
$uid = $_POST['uid'];
// $pid = $_POST['pid'];
echo $cartid;
echo $uid;
// echo $pid;

if (isset($_POST['cartid'])) {
    // เชื่อมต่อกับฐานข้อมูล
    include "dbconn.php";

    // รับค่า cartid จาก POST
    $cartid = intval($_POST['cartid']);

    // ทำการลบข้อมูลในตาราง cart โดยใช้ cartid เป็นเงื่อนไข
    $stmt = $conn->prepare("DELETE FROM cart WHERE cartid = ?");
    $stmt->bind_param("i", $cartid);

    // ดำเนินการลบ
    if ($stmt->execute()) {
        // หากลบสำเร็จ ทำการ redirect กลับไปยังหน้า cart.php
        header("location: cart.php?uid=" . $uid);
        exit; // ออกจากสคริปต์
    } else {
        // หากเกิดข้อผิดพลาดในการลบ สามารถแสดงข้อความผิดพลาดหรือทำการบันทึกลงในไฟล์ log
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $stmt->close();
    $conn->close();
} else {
    // หากไม่มีค่า cartid ถูกส่งมา แสดงข้อความข้อผิดพลาดหรือทำการ redirect กลับไปยังหน้าเดิม
    echo "ไม่มี cartid ที่ระบุ";
}
?>