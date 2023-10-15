<?php
include 'dbconn.php';

$owneruid = $_GET['uid'];
$customeruid = $_POST['customeruid'];
$detail_uid = $_POST['detail_uid'];

// echo $customeruid;
// echo $detail_uid;
// echo $owneruid;


error_reporting(E_ALL);

$user_stmt = $conn->prepare("SELECT * FROM user where uid = ?");
$user_stmt->bind_param('i', $customeruid);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

$pizza_stmt = $conn->prepare("SELECT cart.uid    as cart_uid, cart.price     as cart_price, cart.amount  as cart_amount, cart.status as cart_status
                            , pizza.image       as pizza_image, pizza.name  as pizza_name
                            , crust.name        as crust_name
                            , size.name         as size_name
                            FROM cart 
                            INNER JOIN pizza ON cart.pid = pizza.pid
                            INNER JOIN crust ON cart.cid = crust.cid
                            INNER JOIN size ON cart.sid = size.sid
                            where uid = ?");
$pizza_stmt->bind_param('i', $customeruid);
$pizza_stmt->execute();
$pizza_result = $pizza_stmt->get_result();

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


    <div class="row centercard">
        <div class="col">
            <div class="container">
                <div class="card" style="overflow-y: scroll;">
                    <a href="owner.php?uid=<?= $owneruid ?>" style="margin-top: 1%; margin-left: 1%;">
                        <img src="arrow_back.png" alt="back" width="50px">
                    </a>
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="row">
                            <div class="row" style="margin-top: 1%;">

                                <div class="col-12 text-center">
                                    <?php
                                    if (!empty($customeruid)  && !empty($detail_uid)) {
                                        //ลูกค้าาา

                                    ?>
                                        <div class="col-12 text-center">
                                            <h1 style="text-decoration: underline; ">ข้อมูลลูกค้า</h1>
                                        </div>
                                        <?php
                                        while ($userrow = $user_result->fetch_assoc()) { ?>
                                            <img src="<?= $userrow['picture'] ?>" alt="picture_Customer" style="border-radius: 50%; width: 300px; height: 300px; object-fit: cover; margin-bottom: 2%;">
                                            <h2>UserID : <?= $userrow['uid'] ?></h2>
                                            <h2>Name : <?= $userrow['name'] ?></h2>
                                            <h2>Phone : <?= $userrow['phone'] ?></h2>
                                            <h2>Email : <?= $userrow['email'] ?></h2>
                                            <h2>Address : <?= $userrow['Address'] ?></h2>
                                        <?php
                                        }
                                        // echo "1";
                                        ?>

                                    <?php } else if (!empty($customeruid)  && empty($detail_uid)) {
                                        //Pizza
                                    ?>
                                        <div class="col-12 text-center">
                                            <h1 style="text-decoration: underline; ">ข้อมูลพิซซ่า</h1>
                                        </div>

                                        <div class="row">
                                            <div class="col-3" style="display: flex; justify-content: center;">
                                                <h3>Picture</h3>
                                            </div>
                                            <div class="col-2" style="display: flex; justify-content: center;">
                                                <h3>Name</h3>
                                            </div>
                                            <div class="col-2" style="display: flex; justify-content: center;">
                                                <h3>Details</h3>
                                            </div>
                                            <div class="col-2" style="display: flex; justify-content: center;">
                                                <h3>จำนวน</h3>
                                            </div>
                                            <div class="col-2" style="display: flex; justify-content: center;">
                                                <h3>ราคา</h3>
                                            </div>
                                        </div>
                                        <?php
                                        while ($pizzarow = $pizza_result->fetch_assoc()) { 
                                            if($pizzarow['cart_status'] == 'สั่งแล้ว'){
                                            ?>
                                        
                                            <div class="row" style="border: 2px solid black; margin-top: 1%;">

                                                <div class="col-3" style="display: flex; justify-content: center; ">
                                                    <img src="<?= $pizzarow['pizza_image']; ?>" alt="photo" width="200px" height="130px">
                                                </div>
                                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                                    <h5> <?= $pizzarow['pizza_name']; ?> </h5>
                                                </div>
                                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                                    <h6> <?= $pizzarow['crust_name'] . " , " . $pizzarow['size_name'] ?> </h6>
                                                </div>
                                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                                    <h5> <?= $pizzarow['cart_amount'] ?></h5>
                                                </div>
                                                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                                                    <h5> <?= $pizzarow['cart_price'] ?></h5>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    }
                                    // echo "2";
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