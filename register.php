<?php
include 'dbconn.php';


$stmt = $conn->prepare("Select * from user");
$stmt->execute();
$result = $stmt->get_result();
$result->fetch_assoc();


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">

    <style>
        body {
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1) 0%, rgba(255, 144, 0, 1) 110%);
            transition: background-color .5s ease;
        }

        .cardcenter {
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input {
            background-color: lightgray;
            width: 490px;
            height: 40px;
        }

        .card {
            height: auto;
            border-radius: 20px;

        }
    </style>
</head>

<body>
    <div class="container">

        <div class="row cardcenter">
            <div class="col-5">
                <div class="card">
                    <div class="container">
                        <div style="margin-top: 2%; ">
                            <a href="login.php">
                                <img src="arrow_back.png" alt="back" width="50px">
                            </a>
                        </div>
                        <div class="login-container">
                            <img src="pizza.png" alt="logo" width="100px">
                            <h2>Register</h2>
                        </div>
                        <form action="processregister.php" method="post" style="margin-right: 10%; margin-left: 10%;">
                            <div class="row">
                                <div style="margin-block: 1%; ">
                                    <label for="" name="name">Name | ชื่อ</label><br>
                                    <input type="text" name="name" id="name" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="email">Email | อีเมล</label><br>
                                    <input type="email" name="email" id="email" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="password">Password | รหัสผ่าน</label><br>
                                    <input type="password" name="password" id="password" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="confirmpassword">Confirm Password | รหัสผ่านอีกครั้ง</label><br>
                                    <input type="password" name="confirmpassword" id="confirmpassword" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="phone">Phone | เบอร์โทร</label><br>
                                    <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="Address">Address | ที่อยู่</label><br>
                                    <input type="text" name="Address" id="Address" style="border-radius: 10px; width: 100%; height: 100px;" required>
                                </div>
                                <div style="margin-block: 1%;">
                                    <label for="" name="picture">Picture | รูป</label><br>
                                    <input type="text" name="picture" id="picture" style="border-radius: 50px; width: 100%;" required>
                                </div>
                                
                                <div class="center" style="margin-bottom: 5%; margin-top: 5%;">
                                    <input type="submit" value="Register" class="btn btn-success" style="border-radius: 50px;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>