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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Login Pizza</title>
</head>

<body class="body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div style="margin-top: 2%; ">
                            <a href="index.php">
                                <img src="arrow_back.png" alt="back" width="50px">
                            </a>
                        </div>
                        <div class="card-image"><img src="pizza.png" alt="pizza_icon"></div>
                        <h1 class="card-title"><b>Login</b></h1>
                        <form action="process_login.php" method="post">
                            <label for="email">Email</label><br>
                            <input type="email" id="email" style="border-radius: 50px;" name="email"><br>
                            <label for="password">Password</label><br>
                            <input type="password" id="password" style="border-radius: 50px;" name="password"><br><br>
                            <!-- <label for="type" style="font-size: 18px;">Type</label>
                            <select name="type">
                                <?php
                                foreach ($enum_values as $value) {
                                    echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                                ?>
                            </select> -->
                            <div class="row">
                                <div class="col">
                                    <a class="forgetPass" style="font-size: 18px; justify-content: right; margin-right: 2%;" href="changepassword.php">forget Password?</a>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col">
                                    <div class="center-button">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    <a class="register" href="register.php"><b>(click here for register)</b></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>