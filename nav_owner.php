<?php
include 'dbconn.php';

$uid = $_GET['uid'];
// echo $uid;
$stmt = $conn->prepare("select * from user where uid = ?");
$stmt->bind_param('i', $uid);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a {
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }

        a:hover {
            color: black;
        }

        input {
            display: flex;
            background-color: lightgray;
            width: 240px;
            height: 40px;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav style="background-color: white;">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="container" style="margin-block: 1%;">
                        <ul class="d-flex align-items-center list-unstyled ml-auto">
                            <li style="margin-right: 20px;">
                                <a href="owner.php?uid=<?= $uid ?>" style="text-decoration: none;">
                                    <img src="pizza.png" alt="logo" width="100px">
                                    <li>
                                        <h1>Pizza Shop</h1>
                                    </li>
                            </a>
                            </li>
                            <li style="margin-left: auto;">
                                <!-- <a href="" style="display: flex; align-items: center;"> -->
                                <!-- <img src="shoppingcart.png" alt="shoppingcart" style="margin-top: 10%;" width="70px" height="70px"> -->
                            <li id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                                <?php $row = $result->fetch_assoc() ?>
                                <div class="center">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col center">
                                                    <img src="<?= $row['picture'] ?>" alt="logo" width="150px" height="150px" style=" border-radius: 100%; border: 2px solid black;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col center">
                                                    <h2 class="center" style="margin-block: 5%;"><?= $row['name'] ?></h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col center">
                                                    <h2 class="center" style="margin-block: 5%;"><?= $row['type'] ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col center">
                                        <a href="index.php" style="margin-top: 170%;">ออกจากระบบ</a>
                                    </div>
                                </div>
                            </li>
                            <span style="font-size:50px;cursor:pointer" onclick="openNav()">&#9776;</span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

</body>

</html>