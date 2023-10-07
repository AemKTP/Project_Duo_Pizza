<?php

use function PHPSTORM_META\type;

include "dbconn.php";

// $pid = isset($_GET['pid']) ? $_GET['pid'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <title>Cart</title>

    <nav>

        <?php
        error_reporting(E_ALL);
        // ini_set('display_errors', 1);

        // echo intval($_GET['uid']);
        if ($_POST) {
            $pizza_image = $_POST['pizza_image'];
            $pizza_name = $_POST['pizza_name'];
            $information = $_POST['information'];
            $pizza_price = intval($_POST['pizza_price']);
            $quantity = $_POST['quantity'];

            $pid = intval($_POST['pid']);
            $uid = intval($_POST['uid']);


            if ($pid) {
                $stmt2 = $conn->prepare("Select cart.cartid as cartid, cart.amount as cartamount, pizza.price as pizzaprice, pizza.name as pizzaname 
                                from cart 
                                INNER JOIN pizza ON cart.pid = pizza.pid 
                                where cart.uid = ? and cart.pid = ?");
                $stmt2->bind_param('ii', $uid, $pid);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                $Found = false;

                while ($row2 = $result2->fetch_assoc()) {
                    $Found = true;

                    $newAmount = $quantity + intval($row2['cartamount']);
                    $newPrice = $newAmount * intval($row2['pizzaprice']);
                    $cardId = intval($row2['cartid']);

                    $stmt = $conn->prepare("UPDATE cart SET price=?, amount=? WHERE cartid = ?");
                    $stmt->bind_param('iii', $newPrice, $newAmount, $cardId);
                    $stmt->execute();
                }

                if (!$Found) {


                    $address = "address";
                    $statusna = '1';

                    $fdate = '2023-10-06 10:05:59';
                    $odate = '2023-10-06 10:05:59';

                    $create_bid = $conn->prepare("INSERT INTO `order` (uid, total_price, adress, fdate, odate, status, pid) VALUES(?, 0, ?, ?, ?, ?, ?)");
                    $create_bid->bind_param("issssi", $uid, $address, $fdate, $odate, $statusna, $pid);
                    $create_bid->execute();
                    // print_r($result);


                    $cheack_stmt = $conn->prepare("SELECT * from `order` where uid = ? and pid = ?");
                    $cheack_stmt->bind_param('ii', $uid, $pid);
                    $cheack_stmt->execute();
                    $resultoid = $cheack_stmt->get_result();
                    $rowoid = $resultoid->fetch_assoc();
                    // echo $rowoid['oid'];

                    $create_crat = $conn->prepare("INSERT INTO cart (oid,uid,pid,price,amount) values (?,?,?,?,?)");
                    $create_crat->bind_param("iiiii", $rowoid['oid'], $uid, $pid, $pizza_price, $quantity);
                    $create_crat->execute();
                }
            }
        }


        // print_r($_POST);
        include "nav.php";

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
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Details</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>ราคา</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>จำนวน</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>CheckBlock</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>Delete</h3>
                            </div>
                        </div>
                        <div class="row">
                            <?php $row  = $result->fetch_assoc(); ?>
                            <div class="col" style="display: flex; justify-content:space-between;">
                                <div class="row">
                                    <?php
                                    $newuid = intval($_GET['uid']) or intval($_POST['uid']);
                                    $stmt2 = $conn->prepare("Select * from cart where uid = ?");
                                    $stmt2->bind_param('i', $newuid);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();

                                    $stmt2 = $conn->prepare("Select cart.cartid as cartid, cart.amount as cartamount, cart.price as pizzaprice, pizza.name as pizzaname, pizza.image as pizzaimage
                                                            , crust.name as crustname, size.name as sizename
                                                            from cart 
                                                            INNER JOIN pizza ON cart.pid  = pizza.pid 
                                                            INNER JOIN crust ON pizza.cid = crust.cid
                                                            INNER JOIN size ON pizza.sid = size.sid
                                                            where cart.uid = ? ");
                                    $stmt2->bind_param('i', $uid);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                                    while ($row2 = $result2->fetch_assoc()) { ?>

                                        <div class="col-3" style="display: flex; justify-content: center;">
                                            <img src="<?= $row2['pizzaimage']; ?>" alt="photo" width="200px" height="130px">
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <p> <?= $row2['pizzaname']; ?> </p>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <p> <?= $row2['crustname'] . "," . $row2['sizename'] ?> </p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <p> <?= $row2['pizzaprice']; ?> </p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <p> <?= $row2['cartamount']; ?> </p>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <p> check</p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
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