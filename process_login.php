<?php
include "dbconn.php";

// รับค่า email และ password จากฟอร์ม
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];


print_r($_POST);

$stmt = $conn->prepare("Select * from user");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){

    if($row['email'] == $email){
        echo "success Email"."<br>"; 
        echo $email;
        if (password_verify($password, $row['password'])) {
            if($type == $row['type']){
                if($row['type'] == 'ลูกค้า'){
                    header("Location: customer.php");
                }
                if($row['type'] == 'เจ้าของร้าน'){
                    header("Location: owner.php");
                }
            }
        }
        break;

    }
    else{
        header("Location: login.php");
    }
}
// echo "Not Email"."<br>"; 


?>