<?php
include 'dbconn.php';

$owneruid = $_GET['uid'];
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
    $stmt = $conn->prepare("SELECT * FROM `order`");
    $stmt->execute();
    $result = $stmt->get_result();
    // $stmt = $conn->prepare("SELECT DISTINCT name, odate, oid, uid, total_price
    //                         FROM `order`");
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $stmt = $conn->prepare("SELECT `order`.oid as order_oid, `order`.odate  as order_odate, `order`.total_price as order_total_price
    //                         , user.uid      as user_uid, user.name          as user_name, user.phone            as user_phone
    //                         , user.email    as user_email, user.address     as user_address
    //                         FROM `order`
    //                         INNER JOIN user ON user.uid  = order.uid
    //                         INNER JOIN cart ON cart.oid  = order.oid
    //                         ");
    // $stmt->execute();
    // $result = $stmt->get_result();

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
                                <h3>Order</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>User</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Order_Time</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Price</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Pizza_List</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Status</h3>
                            </div>


                        </div>
                        <div class="row" style="display: flex; justify-content: center; align-items: center; ">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                if ($row['odate'] != 'null') {

                            ?>
                                    <div class="row" style="border: 2px solid black; margin-top: 1%; height: 200px;">
                                        <div class="row" style="margin-left: 2%; margin-right: 2%; align-items: center;">
                                            <div class="col-2">
                                                <div>
                                                    <h6>Order :</h6>
                                                    <h6><?= $row['oid'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-2" style="display: flex;">
                                                <form action="showdetail_owner.php?uid=<?= $owneruid ?>" method="post">
                                                    <div>
                                                        <input type="hidden" name="customeruid" id="customeruid" value="<?= $row['uid']?>">
                                                        <input type="hidden" name="detail_uid" id="detail_uid" value="detail_<?= $row['uid'] ?>">
                                                        <h6 style=" display:flex; justify-content: center;">User : <?= $row['uid'] ?></h6>
                                                        <button type="submit" class="btn btn-primary">รายละเอียดลูกค้า</button>
                                                    </div>

                                                </form>
                                            </div>

                                            <div class="col-2">
                                                <div>
                                                    <h6>Odate : <?= $row['odate'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <h6>Total_Price : <?= $row['total_price'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <form action="showdetail_owner.php?uid=<?= $owneruid ?>" method="post">

                                                    <div>
                                                        <input type="hidden" name="customeruid" id="customeruid" value="<?= $row['uid'] ?>">
                                                        <button type="submit" class="btn btn-primary">รายละเอียดพิซซ่า</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <select style="width: 8rem; height: 2rem;" name="order_status" id="order_status" onchange="">
                                                        <option value="กำลังเตรียมออเดอร์">กำลังเตรียมออเดอร์</option>
                                                        <option value="กำลังส่ง">กำลังส่ง</option>
                                                        <option value="ส่งแล้ว">ส่งแล้ว</option>
                                                        <option value="ยกเลิก">ยกเลิก</option>
                                                    </select>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php }
                            } ?>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>