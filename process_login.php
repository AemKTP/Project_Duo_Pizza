<?php
include "dbconn.php";

// รับค่า email และ password จากฟอร์ม

$email = $_POST['email'];
$password = $_POST['password'];
$type = 'เจ้าของร้าน';


// print_r($_POST);
// echo $type;

// echo "Not Email"."<br>"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
$stmt = $conn->prepare("Select * from user");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){
    // echo $row['name'];

    if($row['email'] == $email){
        if (password_verify($password, $row['password'])) {
            if($row['type']== $type){
                header("Location: owner.php?uid=".$row['uid']);
            }
            else{
                header("Location: customer.php?uid=".$row['uid']);
            }
        }
        break;

    }
    else{

        echo '<script type="text/javascript">';
        echo 'alert("อีเมล หรือ รหัสผ่านไม่ถูกต้อง.");'; // Display an alert dialog
        echo 'window.location.href = "login.php";'; // Redirect to another_page.php
        echo '</script>';

    }
}
    ?>
</body>
</html>