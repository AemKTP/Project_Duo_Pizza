<?php
include "dbconn.php";
$uid = $_GET['uid'];
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<head>
    <title>order</title>
    <style>
        body {
            padding: 0;
            overflow-x: hidden;
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1) 0%, rgba(255, 144, 0, 1) 110%);
            transition: background-color .5s ease;
        }

        nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline-block;
        }

        nav a {
            text-decoration: none;
            padding: 10px;
            color: black;
        }

        .order {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .order button {
            padding: 2%;
            border-radius: 16px;
            text-align: center;
            color: aliceblue;
        }

        .totalprice h2 {
            text-align: center;
        }

        .btntotal {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .btntotal button {
            margin-top: 3%;
            padding: 2%;
            border-radius: 16px;
            width: 30%;
            text-align: center;
            color: aliceblue;
        }
    </style>
</head>
<nav>
    <?php
    include "nav.php";
    ?>
</nav>

<body>
    <?php
    $statusshow = 'ยังไม่สั่ง';
    $stmtselectdetail = $conn->prepare("select pizza.image as imagephoto, pizza.name as namepizza , size.name as sizename, crust.name as crustname, amount, cart.price as pricecart 
                                    from cart inner join  pizza
                                    on  cart.pid = pizza.pid
                                    inner join  crust
                                    on  cart.cid = crust.cid
                                    inner join  size
                                    on  cart.sid = size.sid
                                    where uid = ?
                                    and   status =?");
    $stmtselectdetail->bind_param("is", $uid, $statusshow);
    $stmtselectdetail->execute();
    $resultsldt = $stmtselectdetail->get_result();

    ?>
    <div class="container">
        <div class="row" style="margin-top:2%;">
            <div class="col-8">
                <div class="card" style="margin-bottom:10%;">
                    <div class="container">
                        <h2 style="margin-top:2%;text-decoration:underline">LIST ORDER</h2>
                        <div class="row justify-content-center align-items-center" style="margin-top:4%;">
                            <?php
                            while ($rowrssldt = $resultsldt->fetch_assoc()) { ?>
                                <div class="col-3">
                                    <img src="<?= $rowrssldt['imagephoto'] ?>" alt="Pizza" style="width:100px;">
                                </div>
                                <div class="col-3">
                                    <p class="pizza-name">
                                        <?= $rowrssldt['namepizza'] ?>
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="pizza-size">(
                                        <?= $rowrssldt['sizename'] ?>,
                                        <?= $rowrssldt['crustname'] ?>)
                                        <?= $rowrssldt['amount'] ?> ชิ้น
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="pizza-price">
                                        <?= $rowrssldt['pricecart'] ?> THB
                                    </p>
                                </div>
                                <p style="border-bottom: 2px solid tomato;"></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card" style="height:35%;">
                    <div class="container">
                        <!-- ในส่วน HTML -->
                        <div class="order">
                            <h2 style="margin-top:5%;text-decoration:underline">Address</h2>
                            <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);
                            $selectUserAddress = $conn->prepare("SELECT Address FROM user WHERE uid = ?");
                            $selectUserAddress->bind_param("i", $uid);
                            $selectUserAddress->execute();
                            $resultUserAddress = $selectUserAddress->get_result();
                            $rowUserAddress = $resultUserAddress->fetch_assoc();

                            $selectOrderAddress = $conn->prepare("SELECT adress FROM `order` WHERE uid = ?");
                            $selectOrderAddress->bind_param("i", $uid);
                            $selectOrderAddress->execute();
                            $resultOrderAddress = $selectOrderAddress->get_result();
                            $rowOrderAddress = $resultOrderAddress->fetch_assoc();

                            if ($rowOrderAddress['adress'] != 'null') {
                                $showAddress = $rowOrderAddress['adress'];
                            } else {
                                $showAddress = $rowUserAddress['Address'];
                            }
                            ?>
                            <div id="showAddress" name="showAddress">
                                <?= $showAddress; ?>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Change Address
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>New Address</b></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="update_order_address.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="newAddress">
                                                        <h6><b>New Address:</b></h6>
                                                    </label>
                                                    <input type="text" id="newAddress" name="newAddress" style="width: 450px; height: 250px;" required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="uid" value="<?= $uid ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" onclick="changeAddress()">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                $status = "ยังไม่สั่ง";
                $stmtselect = $conn->prepare("select sum(price) as totalprice from cart where uid = ? and status = ?");
                $stmtselect->bind_param("is", $uid, $status);
                $stmtselect->execute();
                $resultstmtselect = $stmtselect->get_result();
                $delivery = 60;
                if ($rowrssl = $resultstmtselect->fetch_assoc()) {
                ?>
                    <div class="card" style="margin-top:5%;height:30%;">
                        <div class="container">
                            <div class="row">
                                <div class="totalprice">
                                    <h2 style="margin-top: 2%;text-decoration:underline">Total Price</h2>
                                </div>
                                <div class="col-6">
                                    <p><b>price:</b></p>
                                    <p><b>delivery:</b></p>
                                    <p><b>total:</b></p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <?= $rowrssl['totalprice'] ?>
                                    </p>
                                    <p>
                                        <?= $delivery ?>
                                    </p>
                                    <h5>
                                        <?= $rowrssl['totalprice'] + $delivery ?> THB
                                    </h5>
                                </div>
                                <div class="btntotal">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paid">
                                        BUY
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                    ?>
                    <div class="modal fade" id="paid" tabindex="-1" aria-labelledby="paid" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>paymend </b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="processpaid.php?uid=<?= $uid ?>" method="post">
                                        <input type="radio" name="pay" value="1" required>เงินสด
                                        <input type="radio" name="pay" value="2" required>บัตรเครดิต
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        function changeAddress() {
            var newAddress = document.getElementById("newAddress").value;
            document.getElementById("showAddress").innerText = newAddress;
        }
    </script>
</body>

</html>