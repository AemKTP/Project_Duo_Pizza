<?php
include "dbconn.php";

$pid = isset($_GET['pid']) ? $_GET['pid'] : null;

$stmt = $conn->prepare("Select * from")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <nav>

        <?php
        print_r($_POST);
        include "nav.php";
        $uid;


        ?>
    </nav>

    <style>
        html,
        body {
            overflow-x: hidden;
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1)0%, rgba(255, 144, 0, 1)110%);
            transition: background-color .5s ease;
        }

        .centercard {
            display: flex;
            height: 90vh;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>

<body>
    <div class="row centercard">
        <div class="col">
            <div class="container">
                <div class="card">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;" >
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="text-decoration: underline;">รายการสั่งซื้อของท่าน</h1>
                        </div>
                        <div class="row">
                            <div class="col" style="display: flex; justify-content:space-between;">

                                <h3>Picture</h3>
                                <h3>Name</h3>
                                <h3>Details</h3>
                                <h3>ราคา</h3>
                                <h3>จำนวน</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="display: flex; justify-content:space-between;">

                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>