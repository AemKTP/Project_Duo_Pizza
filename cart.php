<?php


include "dbconn.php";

$get = $_POST['add'];
$uid = $_POST['uid'];
$sid = explode(',', $_POST['size']);
$cid = explode(',', $_POST['crust']);



if (isset($_POST['add'])) {
    header("location: cart.php?uid=" . $uid . "&sid=" . $sid[1] . "&cid=" . $cid[1]);
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

            $pizza_name = $_POST['pizza_name'];
            $pizza_image = $_POST['pizza_image'];
            $information = $_POST['information'];
            $pizza_price = intval($_POST['pizza_price']);
            $quantity = $_POST['quantity'];

            $pid = intval($_POST['pid']);
            $uid = intval($_POST['uid']);



            if ($pid) {

                $param_cid_price = intval($cid[0]);
                $param_sid_price = intval($sid[0]);
                $param_cid = intval($cid[1]);
                $param_sid = intval($sid[1]);

                $stmt2 = $conn->prepare("Select cart.cartid as cartid, cart.amount as cartamount, pizza.price as pizzaprice, pizza.name as pizzaname
                                        , crust.name as crustname, size.name as sizename
                                from cart 
                                INNER JOIN pizza ON cart.pid = pizza.pid
                                INNER JOIN crust ON cart.cid = crust.cid
                                INNER JOIN size ON cart.sid = size.sid
                                where cart.uid = ? and cart.pid = ? and cart.cid = ? and cart.sid = ? ");
                $stmt2->bind_param('iiii', $uid, $pid, $param_cid, $param_sid);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                $Found = false;

                while ($row2 = $result2->fetch_assoc()) {

                    $Found = true;

                    $newAmount = $quantity + intval($row2['cartamount']);
                    $newPrice = $newAmount * (intval($row2['pizzaprice']) + $param_cid_price + $param_sid_price);
                    $cardId = intval($row2['cartid']);

                    $stmt = $conn->prepare("UPDATE cart SET price=?, amount=?, cid=?, sid=? WHERE cartid = ?");
                    $stmt->bind_param('iiiii', $newPrice, $newAmount, $param_cid, $param_sid, $cardId);
                    $stmt->execute();
                }

                if (!$Found) {


                    $newAmount = $quantity;
                    $newPrice = $newAmount * ($pizza_price + $param_cid_price + $param_sid_price); // คำนวณราคารวมใหม่ตามจำนวนชิ้นใหม่

                    $address = "address";
                    $statuspizza = '1';

                    // รับเวลาปัจจุบันของเครื่อง
                    // date_default_timezone_set('Asia/Bangkok');
                    // $current_time = date('Y-m-d H:i:s');


                    // $create_bid = $conn->prepare("INSERT INTO `order` (uid, total_price, adress, fdate, odate, status) VALUES(?, 0, ?, 'null', 'null', ?)");
                    // $create_bid->bind_param("iss", $uid, $address, $statuspizza);
                    // $create_bid->execute();

                    // $cheack_stmt = $conn->prepare("SELECT * from `order` where uid = ? ");
                    // $cheack_stmt->bind_param('i', $uid);
                    // $cheack_stmt->execute();
                    // $resultoid = $cheack_stmt->get_result();
                    // $rowoid = $resultoid->fetch_assoc();

                    // $cheack_stmt = $conn->prepare("SELECT * from `order` where uid = ? ");
                    // $cheack_stmt->bind_param('i', $uid);
                    // $cheack_stmt->execute();
                    // $resultoid = $cheack_stmt->get_result();
                    // $rowoid = $resultoid->fetch_assoc();

                    // echo $cid[1];
                    // echo $sid[1];
                    $param_cid = intval($cid[1]);
                    $param_sid = intval($sid[1]);
                    $create_crat = $conn->prepare("INSERT INTO cart (uid, pid, price, amount, cid, sid, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $create_crat->bind_param("iiddiis", $uid, $pid, $newPrice, $newAmount, $param_cid, $param_sid, $statuspizza); // ใช้ $newPrice และ $newAmount แทน $pizza_price และ $quantity
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

                                $allpizza = [];

                                $stmt2 = $conn->prepare("Select cart.cartid as cartid, cart.amount as cartamount, cart.price as pizza_price
                                                            , pizza.name as pizza_name, pizza.image as pizza_image
                                                            , crust.name as crust_name, size.name as size_name
                                                            from cart 
                                                            INNER JOIN pizza ON cart.pid  = pizza.pid 
                                                            INNER JOIN crust ON cart.cid = crust.cid
                                                            INNER JOIN size ON cart.sid = size.sid
                                                            where cart.uid = ?");
                                $stmt2->bind_param('i', $newuid);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();


                                while ($row2 = $result2->fetch_assoc()) { ?>

                                    <div class="row" style="border: 2px solid black; margin-top: 1%;">

                                        <div class="col-2" style="display: flex; justify-content: center; ">
                                            <img src="<?= $row2['pizza_image']; ?>" alt="photo" width="200px" height="130px">
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <h5> <?= $row2['pizza_name']; ?> </h5>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                            <h6> <?= $row2['crust_name'] . " , " . $row2['size_name'] ?> </h6>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center;">
                                            <h5 data-price="<?= $row2['pizza_price']; ?>" id="price<?= $row2['cartid']; ?>">
                                                <?= number_format($row2['pizza_price'], 2) ?>
                                            </h5>
                                        </div>
                                        <div class="col-2" style="display: flex; align-items: center; margin-left: 6rem; ">
                                            <form action="upanddown.php?uid=<?= $uid ?>" method="post" style="margin-right: 8%">
                                                <input type="hidden" name="lock" id="lock" value="1">
                                                <input type="hidden" name="process" id="process" value="-1">
                                                <input type="hidden" name="cartid" id="cartid" value="<?= $row2['cartid'] ?>">
                                                <button type="submit" class="btn btn-danger">-</button>
                                            </form>
                                            <h6 id="quantity<?= $row2['cartid'] ?>"> <?= $row2['cartamount']; ?> </h6>
                                            <form action="upanddown.php?uid=<?= $uid ?>" method="post" style="margin-left: 8%;">
                                                <input type="hidden" name="process" id="process" value="1">
                                                <input type="hidden" name="cartid" id="cartid" value="<?= $row2['cartid'] ?>">
                                                <button type="submit" class="btn btn-success"> + </button>
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
                <form action="">
                    <div class="card" style="height: 100px; border-radius: 20px; margin-top: 1%;">
                        <div class="row" style="height: 100%;">
                            <div class="col-7" style="display: flex; align-items: center; margin-inline-start: 5%;">
                            <?php
                                $stmtselects=$conn->prepare("select sum(price) as totalprice from  cart where uid=?");
                                $stmtselects->bind_param("i",$uid);
                                $stmtselects->execute();
                                $resultselects=$stmtselects->get_result();
                                while($rowselect=$resultselects->fetch_assoc()){
                             ?>
                                <b><h2>ราคารวม</h2></b>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center; align-items: center; margin-right: 0%;">
                                <h2>
                                    <?= number_format($rowselect['totalprice'],0)?>
                                </h2>
                                <h2>
                                       บาท
                                </h2>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="col-2" style="display: flex; justify-content: center; align-items: center; margin-right: 1%;">
                                <button type="button" class="btn btn-success">ยืนยันการสั่งซื้อ</button>
                            </div>
                        </div>
                       
                    </div>
                </form>
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