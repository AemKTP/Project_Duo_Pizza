<?php
include 'dbconn.php';

$uid = $_GET['uid'];


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomerStatus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a0b197089f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">

    <nav>
        <?php
        include 'nav.php';
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
    <div class="row centercard" style="margin-top: 3%;">
        <div class="col">
            <div class="container">
                <div class="card" style="overflow-y: scroll;">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="text-decoration: underline;">สถานะการสั่งซื้อ</h1>
                        </div>

                        <!-- <div class="row" style="margin-top: 0%; border-bottom: 2px solid tomato;">
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Date</h3>
                            </div>
                            <div class="col-4" style="display: flex; justify-content: center;">
                                <h3>Details</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Amount</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Price</h3>
                            </div>
                            <div class="col-2" style="display: flex; justify-content: center;">
                                <h3>Status</h3>
                            </div>


                        </div> -->
                        <div class="row" style="display: flex; justify-content: center; align-items: center; ">
                            <?php
                            $statusshow = "สั่งแล้ว";
                            $stmt = $conn->prepare("SELECT round, cart.oid as orderid ,odate, `order`.status as statusorder
                                                    FROM `order`
                                                    INNER JOIN cart ON `order`.oid = cart.oid
                                                    WHERE `order`.uid = ?
                                                    AND    cart.status = ?
                                                    GROUP BY round,odate,orderid,statusorder");
                            $stmt->bind_param("is", $uid, $statusshow);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $counter = 0;

                            while ($row = $result->fetch_assoc()) {
                                if ($counter >= 0) {
                                    echo '<div class="row" style="border-bottom: 2px solid tomato; margin-top: 1%; height: auto;">';
                                }
                                $counter++;

                                echo '<div class="row" style="margin-left: 2%; margin-right: 2%; align-items: center;">
                                    <div class="col-2">
                                        <div>
                                            <h6>Order: ' . $row['round'] . ',<br>Date: ' . $row['odate'] . '</h6>
                                        </div>
                                    </div>';

                                if ($row) {
                                    $totalPrice = 60;
                                    $stmtpizza = $conn->prepare("SELECT pizza.name as pizzaname, crust.name as crustname, size.name as sizename, SUM(cart.price) as price, SUM(cart.amount) as amount
                                                                    FROM cart
                                                                    INNER JOIN pizza ON cart.pid = pizza.pid
                                                                    INNER JOIN size ON cart.sid = size.sid
                                                                    INNER JOIN crust ON cart.cid = crust.cid
                                                                    WHERE cart.uid = ?
                                                                    AND cart.oid = ?
                                                                    AND cart.status = ?
                                                                    group by pizzaname,crustname,sizename");
                                    $stmtpizza->bind_param("iis", $uid, $row['orderid'], $statusshow);
                                    $stmtpizza->execute();
                                    $resultpizza = $stmtpizza->get_result();

                                    $statusshow2 = false;
                                    while ($rowpizza = $resultpizza->fetch_assoc()) {
                                        // echo $rowpizza['pizzaname'];
                                        if ($rowpizza) {
                                            echo '<div class="col-4">
                                                <div>
                                                    <h6>' . $rowpizza['pizzaname'] . ' (' . $rowpizza['sizename'] . ',' . $rowpizza['crustname'] . ')</h6>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <h6>' . $rowpizza['amount'] . ' ชิ้น</h6>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <h6> ' . $rowpizza['price'] . ' THB</h6>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>';
                                            if ($statusshow2 == false) {
                                                echo '  <h6>' . $row['statusorder'] . '</h6> ';
                                            }
                                            echo    '</div>
                                            </div>
                                            <div class="col-2">
                                            </div>';
                                            $totalPrice += $rowpizza['price'];
                                            $statusshow2 = true;
                                        }
                                    }
                                        echo '<div class="col-12" style="text-align: right;">
                                        <i class="fa-regular fa-money-bill" style="color: #77bb41;"><h6><strong>Total Price: ' . $totalPrice . ' THB</strong></h6></i></div>';
                                }
                                echo '</div>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>