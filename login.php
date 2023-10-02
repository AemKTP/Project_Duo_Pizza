<?php
include_once('dbconn.php');


$sql = "SHOW COLUMNS FROM user WHERE Field = 'type'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $enum_values = explode(",", str_replace("'", "", substr($row["Type"], 5, -1)));
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Login Pizza</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-image"><img src="https://png.pngtree.com/png-vector/20230318/ourmid/pngtree-modern-traditional-food-sasami-pizza-3d-model-png-image_6651528.png" alt="pizza_icon"></div>
                        <h1 class="card-title"><b>Login</b></h1>
                        <form action="process_login.php" method="post">
                            <label for="email">Email</label><br>
                            <input type="text" id="email" name="email"><br>
                            <label for="password">Password</label><br>
                            <input type="text" id="password" name="password"><br><br>
                            <label for="type">Type</label>
                            <select name="type">
                                <?php
                                foreach ($enum_values as $value) {
                                    echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                                ?>
                            </select>
                            <a class="forgetPass" href="changepassword.php">forget Password?</a>
                            <div class="center-button">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <a class="register" href="register.php"><b>(click here for register)</b></a>
                        </form>
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == "รหัสผ่านไม่ถูกต้อง") {
                            echo '<script>';
                            echo 'alert("รหัสผ่านไม่ถูกต้อง");';
                            echo '</script>';
                        } elseif (isset($_GET['error']) && $_GET['error'] == "ไม่พบบัญชีผู้ใช้") {
                            echo '<script>';
                            echo 'alert("ไม่พบบัญชีผู้ใช้");';
                            echo '</script>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
