<?php
include "dbconn.php";

$uid = $_GET['uid'];
$newname = $_POST['newname'];
$newphone = $_POST['newphone'];
$newemail = $_POST['newemail'];
$newaddress = $_POST['newaddress'];
$newpicture = $_POST['newpicture'];

// echo $uid;
// echo $newname;
// echo $newphone;
// echo $newemail;
// echo $newaddress;
// echo $newpicture;


$stmt = $conn->prepare("Select * from user where uid = ?");
$stmt->bind_param('i', $uid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(empty($newname)){
    $newname = $row['name'];
    
}
if(empty($newphone)){
    $newphone = $row['phone'];
    
}
if(empty($newemail)){
    $newemail = $row['email'];
    
}
if(empty($newaddress)){
    $newaddress = $row['Address'];
    
}
if(empty($newpicture)){
    $newpicture = $row['picture'];
    
}


$change_detail = $conn->prepare("Update user Set name = ?, phone = ?, email = ?, Address = ? , picture = ? where uid = ?");
$change_detail->bind_param('sssssi', $newname, $newphone, $newemail, $newaddress, $newpicture, $uid);
$change_detail->execute();

echo '<script>window.location.href = "detailuser.php?uid='.$uid.'";</script>';


// $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
