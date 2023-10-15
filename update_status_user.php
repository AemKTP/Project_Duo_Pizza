<?php
include 'dbconn.php';

$owneruid = $_GET['uid'];
$status = $_POST['order_status'];

$user_uid = $_POST['customeruid'];
$order_round  = $_POST['customerround'];

// echo $status;
// echo '<br>';
// echo $user_uid;
// echo '<br>';
// echo $order_round;

error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Bangkok');
$current_time = date('Y-m-d H:i:s');



if($status == 'ส่งแล้ว'){
    
    $update_stmt = $conn->prepare("Update `order` set status = ?, fdate = ? where uid = ? and round = ?");
    $update_stmt->bind_param('ssii', $status, $current_time, $user_uid, $order_round);
    $update_stmt->execute();
}
else{
    $update_stmt = $conn->prepare("Update `order` set status = ?, fdate = ? where uid = ? and round = ?");
    $update_stmt->bind_param('ssii', $status, $status, $user_uid, $order_round);
    $update_stmt->execute();


}
header("location: owner.php?uid=$owneruid");


?>