<?php
include 'dbconn.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$phone = $_POST['phone'];
$Address = $_POST['Address'];
$picture = $_POST['picture'];

error_reporting(E_ALL);
ini_set('display_errors', 1);


$check_email_stmt = $conn->prepare("SELECT email
                                    FROM user
                                    where email = ?");
$check_email_stmt->bind_param('s', $email);
$check_email_stmt->execute();
$check_email_result = $check_email_stmt->get_result();
$check_email_row = $check_email_result->fetch_assoc();




if(!$check_email_row){
    
    if ($password == $confirmpassword) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $rigister_stmt = $conn->prepare("INSERT INTO user (name, email, password, phone, Address, picture, type) Value (?, ?, ?, ?, ?, ?, 'ลูกค้า')");
        $rigister_stmt->bind_param('ssssss', $name, $email, $hashed_password, $phone, $Address, $picture);
        $rigister_stmt->execute();
    
        echo '<script type="text/javascript">';
        echo 'alert("สมัครเสร็จสิ้น.");'; // Display an alert dialog
        echo 'window.location.href = "login.php";'; // Redirect to another_page.php
        echo '</script>';
    } else {
    
        echo '<script type="text/javascript">';
        echo 'alert("รหัสผ่านไม่ตรงกัน.");'; // Display an alert dialog
        echo 'window.location.href = "register.php";'; // Redirect to another_page.php
        echo '</script>';
    }
}
else{
    echo '<script type="text/javascript">';
    echo 'alert("อีเมลซ้ำ.");'; // Display an alert dialog
    echo 'window.location.href = "register.php";'; // Redirect to another_page.php
    echo '</script>';

}

