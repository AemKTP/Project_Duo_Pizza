<?php

use function PHPSTORM_META\type;

include "dbconn.php";

$get = $_POST['add'];
$uid = $_POST['uid'];
if (isset($_POST['add'])) {

    header("location: cart.php?uid=" . $uid);
}

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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


                    // $address = "address";
                    // $statusna = '1';

                    // $fdate = '2023-10-06 10:05:59';
                    // $odate = '2023-10-06 10:05:59';

                    // $create_bid = $conn->prepare("INSERT INTO `order` (uid, total_price, adress, fdate, odate, status, pid) VALUES(?, 0, ?, ?, ?, ?, ?)");
                    // $create_bid->bind_param("issssi", $uid, $address, $fdate, $odate, $statusna, $pid);
                    // $create_bid->execute();
                    // // print_r($result);


                    // $cheack_stmt = $conn->prepare("SELECT * from `order` where uid = ? and pid = ?");
                    // $cheack_stmt->bind_param('ii', $uid, $pid);
                    // $cheack_stmt->execute();
                    // $resultoid = $cheack_stmt->get_result();
                    // $rowoid = $resultoid->fetch_assoc();
                    // // echo $rowoid['oid'];

                    // $create_crat = $conn->prepare("INSERT INTO cart (oid,uid,pid,price,amount) values (?,?,?,?,?)");
                    // $create_crat->bind_param("iiiii", $rowoid['oid'], $uid, $pid, $pizza_price, $quantity);
                    // $create_crat->execute();

                    $newAmount = $quantity;
                    $newPrice = $newAmount * $pizza_price; // คำนวณราคารวมใหม่ตามจำนวนชิ้นใหม่

                    $address = "address";
                    $statuspizza = '1';

                    $fdate = '2023-10-06 10:05:59';
                    $odate = '2023-10-06 10:05:59';

                    $create_bid = $conn->prepare("INSERT INTO `order` (uid, total_price, adress, fdate, odate, status, pid) VALUES(?, 0, ?, ?, ?, ?, ?)");
                    $create_bid->bind_param("issssi", $uid, $address, $fdate, $odate, $statuspizza, $pid);
                    $create_bid->execute();

                    $cheack_stmt = $conn->prepare("SELECT * from `order` where uid = ? and pid = ?");
                    $cheack_stmt->bind_param('ii', $uid, $pid);
                    $cheack_stmt->execute();
                    $resultoid = $cheack_stmt->get_result();
                    $rowoid = $resultoid->fetch_assoc();

                    $create_crat = $conn->prepare("INSERT INTO cart (oid, uid, pid, price, amount) VALUES (?, ?, ?, ?, ?)");
                    $create_crat->bind_param("iiidd", $rowoid['oid'], $uid, $pid, $newPrice, $newAmount); // ใช้ $newPrice และ $newAmount แทน $pizza_price และ $quantity
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

        .checkbox {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-left: -0.5em;
        }

        .table-wrapper {
            overflow-y: scroll;
        }

        .card {
            height: 730px;
            border-radius: 20px;

        }
    </style>
</head>

<body>

    <div class="row centercard" style="margin-top: 3%;">
        <div class="col">
            <div class="container">
                <div class="card" style="overflow-y: scroll;">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="text-decoration: underline;">รายการสั่งซื้อของท่าน</h1>
                        </div>

                        <div class="row">
                            <div class="col-2" style="display: flex; justify-content: center;">
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
                            <div class="col-3" style="display: flex; justify-content: center;">
                                <h3>จำนวน</h3>
                            </div>
                            <div class="col-1" style="display: flex; justify-content: center;">
                                <h3>Delete</h3>
                            </div>
                        </div>
                        <div class="row" style="display: flex; justify-content: center; align-items: center; ">

                            <?php $row  = $result->fetch_assoc(); ?>

                            <div class="row" style="display: flex; justify-content: center; align-items: center; ">
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
                                    <div class="row" style="border: 2px solid black; margin-top: 1%;">

                                        <div class="col-2" style="display: flex; justify-content: center; ">
                                            <img src="<?= $row2['pizzaimage']; ?>" alt="photo" width="200px" height="130px">
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <h5> <?= $row2['pizzaname']; ?> </h5>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <h6> <?= $row2['crustname'] . " , " . $row2['sizename'] ?> </h6>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <h5 data-price="<?= $row2['pizzaprice']; ?>" id="price<?= $row2['cartid']; ?>">
                                                <?= number_format($row2['pizzaprice'], 2) ?>
                                            </h5>
                                        </div>
                                        <div class="col-2" style="display: flex; align-items: center; margin-left: 6rem; ">
                                            <form action="upanddown.php?uid=<?= $uid ?>" method="post" style="margin-right: 8%">
                                                <input type="hidden" name="lock" id="lock" value="1">
                                                <input type="hidden" name="process" id="process" value="-1">
                                                <input type="hidden" name="cartid" id="cartid" value="<?= $row2['cartid'] ?>">
                                                <button type="submit" class="btn btn-danger" >-</button>
                                            </form>
                                            <h6 id="quantity<?= $row2['cartid'] ?>"> <?= $row2['cartamount']; ?> </h6>
                                            <form action="upanddown.php?uid=<?= $uid ?>" method="post" style="margin-left: 8%;">
                                                <input type="hidden" name="process" id="process" value="1">
                                                <input type="hidden" name="cartid" id="cartid" value="<?= $row2['cartid'] ?>">
                                                <button type="submit" class="btn btn-success" > + </button>
                                            </form>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <form action="deletecart.php" method="post" class="delete-form">
                                                <input type="hidden" name="uid" value="<?= $uid ?>">
                                                <input type="hidden" name="cartid" value="<?= $row2['cartid'] ?>">
                                                <button type="submit" class="btn btn-danger" value="">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    ยังไม่ทำ
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach((form) => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this item!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form for item deletion
                    }
                });
            });
        });
    });
</script>



</html>