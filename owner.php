<?php
include 'dbconn.php';

$owneruid = $_GET['uid'];


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">

    <nav>
        <?php
        include 'nav_owner.php';
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

<body class="bgcolor">

    <?php


    $pizza_stmt = $conn->prepare("SELECT distinct `order`.round as order_round, `order`.uid as order_uid, `order`.odate as order_date
                                FROM `order`
                                ");
    $pizza_stmt->execute();
    $pizza_result = $pizza_stmt->get_result();

    ?>

    <div class="row centercard" style="margin-top: 3%;">
        <div class="col">
            <div class="container">
                <div class="card" style="overflow-y: scroll;">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="text-decoration: underline;">รายการสั่งซื้อของลูกค้า</h1>
                        </div>

                        <div class="row" style="margin-top: 0%;">
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>Order</h4>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>User</h4>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>Start_Time</h4>
                                <h4>/End_Time</h4>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>Price</h4>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>Pizza_List</h4>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h4>Status</h4>
                            </div>

                        </div>
                        <div class="row" style="display: flex; justify-content: center; align-items: center; ">
                            <?php

                            $counter = 1;


                            while ($row_pizza = $pizza_result->fetch_assoc()) {

                                if ($row_pizza['order_date'] != 'null') {

                                    $pizza_stmt_check = $conn->prepare("SELECT distinct`order`.round as order_round, `order`.uid as order_uid, `order`.odate as order_date, `order`.fdate as final_date, `order`.status as order_status
                                                                        , sum(cart.price) as cart_price
                                                                        FROM `order`
                                                                        INNER JOIN cart ON cart.oid = `order`.oid
                                                                        where `order`.round = ? and `order`.uid = ? and `order`.odate = ?
                                                                        group by order_round, order_uid, order_date, final_date,order_status
                                                                        ");
                                    $pizza_stmt_check->bind_param('iis', $row_pizza['order_round'], $row_pizza['order_uid'], $row_pizza['order_date']);
                                    $pizza_stmt_check->execute();
                                    $pizza_result_check = $pizza_stmt_check->get_result();

                                    while ($row_pizza_check = $pizza_result_check->fetch_assoc()) {
                                        $statusList = array(
                                            $row_pizza_check['order_status'],
                                            "กำลังเตรียมออเดอร์",
                                            "กำลังส่ง",
                                            "ส่งแล้ว",
                                            "ยกเลิก"
                                        );

                            ?>
                                        <div class="row" style="border: 2px solid black; margin-top: 1%; height: 200px;">
                                            <div class="row" style="margin-left: 2%; margin-right: 2%; align-items: center;">
                                                <div class="col-2">
                                                    <div>
                                                        <h6>Order :</h6>
                                                        <h6><?= $counter ?></h6>
                                                    </div>
                                                </div>
                                                <div class="col-2" style="display: flex;">
                                                    <form action="showdetail_owner.php?uid=<?= $owneruid ?>" method="post">
                                                        <div>
                                                            <input type="hidden" name="customeruid" id="customeruid" value="<?= $row_pizza_check['order_uid'] ?>">
                                                            <input type="hidden" name="detail_uid" id="detail_uid" value="detail_<?= $row_pizza_check['order_uid'] ?>">
                                                            <h6 style=" display:flex; justify-content: center;">User : <?= $row_pizza_check['order_uid'] ?></h6>
                                                            <button type="submit" class="btn btn-primary">รายละเอียดลูกค้า</button>
                                                        </div>

                                                    </form>
                                                </div>

                                                <div class="col-2">
                                                    <div>
                                                        <h6 style="border: 2px solid black; margin-block: 5%;">Start_Time : <?= $row_pizza_check['order_date'] ?></h6>
                                                        <h6 style="border: 2px solid black; margin-block: 5%;">End_Time : <?= $row_pizza_check['final_date'] ?></h6>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div>
                                                        <h6>Total_Price : <?= $row_pizza_check['cart_price']; ?></h6>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <form action="showdetail_owner.php?uid=<?= $owneruid ?>" method="post">

                                                        <div>
                                                            <input type="hidden" name="customeruid" id="customeruid" value="<?= $row_pizza_check['order_uid'] ?>">
                                                            <input type="hidden" name="customerround" id="customerround" value="<?= $row_pizza_check['order_round'] ?>">
                                                            <button type="submit" class="btn btn-primary">รายละเอียดพิซซ่า</button>
                                                        </div>
                                                    </form>
                                                </div>


                                                <div class="col-2">
                                                    <form action="update_status_user.php?uid=<?= $owneruid ?>" method="post">
                                                        <div>
                                                            <select style="width: 8rem; height: 2rem;" name="order_status" id="order_status">
                                                                <?php
                                                                // ใช้เพื่อเก็บค่าที่เคยเห็นแล้ว
                                                                $seen = array();

                                                                foreach ($statusList as $status) {
                                                                    if (!in_array($status, $seen)) {
                                                                        echo '<option value="' . $status . '">' . $status . '</option>';
                                                                        $seen[] = $status; // เพิ่มค่านี้เข้าไปในค่าที่เคยเห็นแล้ว
                                                                    }
                                                                }
                                                                ?>
                                                            </select>


                                                            <input type="hidden" name="customeruid" id="customeruid" value="<?= $row_pizza_check['order_uid'] ?>">
                                                            <input type="hidden" name="customerround" id="customerround" value="<?= $row_pizza_check['order_round'] ?>">
                                                            <button type="submit" class="btn btn-success" style="margin-top: 15%;">เปลี่ยน Status</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                                        $counter = $counter + 1;
                                    }
                                }
                            } ?>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // รับค่าจาก PHP และตั้งค่าใน JavaScript
        var initialOrderStatus = "<?= $row_pizza_check['order_status'] ?>";
        var select = document.getElementById("order_status");

        // ตั้งค่าเลือกเริ่มต้นใน <select>
        for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].value === initialOrderStatus) {
                select.selectedIndex = i;
                break;
            }
        }
    </script>
</body>

</html>