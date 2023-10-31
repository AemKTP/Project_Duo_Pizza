<?php
include 'dbconn.php';

$useruid = $_GET['uid'];
$name = $_POST['name'];
$newAddress = $_POST['newAddress'];
$phone = $_POST['phone'];


error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Bangkok');
$current_time = date('Y-m-d H:i:s');

$statuspizza = '2';
$statuscart = '2';

$updatecartstmt = $conn->prepare("update cart set status = ? where uid = ?");
$updatecartstmt->bind_param('si', $statuscart, $useruid);
$updatecartstmt->execute();

$selectstmt = $conn->prepare("select round from `order` where uid = ?");
$selectstmt->bind_param("i", $useruid);
$selectstmt->execute();
$resultselectstmt = $selectstmt->get_result();

$userstmt = $conn->prepare("select * from user where uid = ?");
$userstmt->bind_param("i", $useruid);
$userstmt->execute();
$userresult = $userstmt->get_result();
$userrow = $userresult->fetch_assoc();

if(empty($name)){
    $name = $userrow['name'];
}
if(empty($newAddress)){
    $newAddress = $userrow['Address'];
}
if(empty($phone)){
    $phone = $userrow['phone'];
}
$address=$name.', '.$newAddress.', '.'phone: '.$phone;

echo $address;
$round = 1;
while ($rowrslstmt = $resultselectstmt->fetch_assoc()) {
    
    
    if ($rowrslstmt['round'] && $rowrslstmt['round'] >= $round) {
        $round = $rowrslstmt['round']+1;
        
    }
}
$statusorder = 'null';
$waiting_order = 'กำลังเตรียมออเดอร์';

$updateorderstmt = $conn->prepare("update `order` set fdate = ?, odate = ?, status = ?, adress = ?, round = ? where uid = ? and status = ?");
$updateorderstmt->bind_param('ssssiis', $waiting_order, $current_time, $statuspizza, $address, $round, $useruid, $statusorder );
$updateorderstmt->execute();

header("location: customerstatus.php?uid=".$useruid);
