<?php
include "dbconn.php";

// รับค่า email และ password จากฟอร์ม
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];


// print_r($_POST);

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

    if($row['email'] == $email){
        if (password_verify($password, $row['password'])) {
            if($type == $row['type']){
                if($row['type'] == 'ลูกค้า'){

                    header("Location: customer.php?uid=".$row['uid']);
                    ?>
                    

                <?php
                }
                if($row['type'] == 'เจ้าของร้าน'){
                    header("Location: owner.php?uid=".$row['uid']);

                     
                }
            }
        }
        break;

    }
    else{
        header("Location: login.php");
    }
}
    ?>
</body>
</html>