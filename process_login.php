<?php
include "dbconn.php";

// รับค่า email และ password จากฟอร์ม
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];



// // ดำเนินการตรวจสอบข้อมูลในฐานข้อมูล
// $sql = "SELECT * FROM user WHERE email = '$email'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $hashedPassword = $row['password'];

//     // ตรวจสอบรหัสผ่าน
//     if (password_verify($password, $hashedPassword)) {
//         // รหัสผ่านถูกต้อง
//         header('Location: owner.php');
//         exit();
//     } else {
//         // รหัสผ่านไม่ถูกต้อง
//         header('Location: login.php?error=รหัสผ่านไม่ถูกต้อง');
//         exit();
//     }
// } else {
//     // ไม่พบบัญชีผู้ใช้
//     header('Location: login.php?error=ไม่พบบัญชีผู้ใช้');
//     exit();
// }

print_r($_POST);

$stmt = $conn->prepare("Select * from user");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){

    // echo "<br>".$row['type'];
    // echo $type;
    // if (password_verify($password, $row['password'])) {
    //     header("Location: owner.php");
    // }
    

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