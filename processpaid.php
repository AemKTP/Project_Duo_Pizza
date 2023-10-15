<?php
include 'dbconn.php';

$useruid = $_GET['uid'];

error_reporting(E_ALL);
// echo $useruid;
// echo "tesr";
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


$round = 1;
while ($rowrslstmt = $resultselectstmt->fetch_assoc()) {
    
    
    if ($rowrslstmt['round'] && $rowrslstmt['round'] >= $round) {
        $round = $rowrslstmt['round']+1;
        
    }
}
$statusorder = 'null';
$waiting_order = 'กำลังเตรียมออเดอร์';

$updateorderstmt = $conn->prepare("update `order` set fdate = ?, odate = ?, status = ?, round = ? where uid = ? and status = ?");
$updateorderstmt->bind_param('sssiis', $waiting_order, $current_time, $statuspizza, $round, $useruid, $statusorder);
$updateorderstmt->execute();

header("location: customerstatus.php?uid=".$useruid);
