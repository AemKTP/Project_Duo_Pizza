<?php
include "dbconn.php";

// $pid = isset($_GET['pid']) ? $_GET['pid'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <nav>

        <?php
        // print_r($_POST);
        include "nav.php";
        $pizza_image = $_POST['pizza_image'];
        $pizza_name = $_POST['pizza_name'];
        $information = $_POST['information'];
        $pizza_price = $_POST['pizza_price'];
        $quantity = $_POST['quantity'];

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
    <!-- <?php
            $stmt = $conn->prepare("SELECT pizza.name AS pizza_name, pizza.price AS pizza_price, pizza.image AS pizza_image, 
                            crust.name AS crust_name, crust.price AS crust_price, 
                            size.name AS size_name, size.price AS size_price
                            FROM pizza
                            JOIN size ON pizza.sid = size.sid
                            JOIN crust ON pizza.cid = crust.cid");
            $stmt->execute();
            $result = $stmt->get_result();
            ?> -->

    <div class="row centercard">
        <div class="col">
            <div class="container">
                <div class="card">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="text-decoration: underline;">รายการสั่งซื้อของท่าน</h1>
                        </div>

                        <div class="row" style="display: flex; justify-content: center; align-items: center;">
                            <div class="col-3" style="display: flex; justify-content: center;">
                                <h3>Picture</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Name</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>Details</h3>
                            </div>
                            <div class="col-3" style="display: flex; justify-content: center;">
                                <h3>ราคา</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>จำนวน</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>CheckBlock</h3>
                            </div>
                        </div>

                        <div class="row">
                            <?php $row  = $result->fetch_assoc(); ?>
                            <div class="col" style="display: flex; justify-content:space-between;">
                                <div class="col-3" style="display: flex; justify-content: center;">
                                    <img src="<?= $pizza_image ?>" alt="photo" width="200px">
                                </div>
                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                    <p> <?= $pizza_name ?> </p>
                                </div>
                                <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                    <p> <?= $information ?> </p>
                                </div>
                                <div class="col-3" style="display: flex; justify-content: center; align-items: center;">
                                    <p> <?= $pizza_price ?> </p>
                                </div>
                                <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                    <p> <?= $quantity ?> </p>
                                </div>
                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                    <p> check </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>