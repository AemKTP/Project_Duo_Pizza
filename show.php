<!-- ยังไม่มี uid -->
<?php
include "dbconn.php";

$pid = isset($_GET['pid']) ? $_GET['pid'] : null;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>pizzaShow</title>
</head>
<nav>
    <?php
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

    a:hover {
        color: black;
    }

    .card {
        height: auto;
        border-radius: 20px;
    }

    .btn {
        border-radius: 30px;
        color: #fff;
        cursor: pointer;
        font-weight: 700;
        width: 20rem;
        height: 6rem;
        line-height: 1em;
        max-width: 100%;
        outline: none;
        padding: 10px;
        text-align: center;
        align-items: center;
    }
    .centercard{
        display: flex;
        height: 90vh;
        justify-content: center;
        align-items: center;

    }

    /* สำหรับ dropdown */
    select {
        width: 200px;
        /* ปรับขนาดความกว้างตามที่คุณต้องการ */
        height: 40px;
        /* ปรับขนาดความสูงตามที่คุณต้องการ */
        font-size: 16px;
        /* ปรับขนาดตัวอักษรใน dropdown */
        padding: 5px;
        /* ปรับระยะห่างของข้อความภายใน dropdown */
    }

    /* สำหรับ option ใน dropdown */
    select option {
        font-size: 16px;
        /* ปรับขนาดตัวอักษรของ option ภายใน dropdown */
    }
</style>


<!-- <article> -->

<body>
    <div class="container">
        <div class="row justify-content-center centercard">
            <div class="col-6">
                <?php
                $stmt = $conn->prepare("SELECT
                    pizza.pid,
                    pizza.name as name_pizza,
                    pizza.image as image_pizza,
                    pizza.price as pizza_price,
                    crust.name as crust_name,
                    size.price as size_price,
                    size.name  as size_name,
                    crust.price as crust_price
                        FROM pizza
                        INNER JOIN size ON pizza.sid = size.sid
                        INNER JOIN crust ON pizza.cid = crust.cid
                        WHERE pizza.pid = ?");
                $stmt->bind_param('i', $pid);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();



                $sizeStmt = $conn->prepare("SELECT name, price FROM size");
                $sizeStmt->execute();
                $sizeResult = $sizeStmt->get_result();


                $sizes = [];
                while ($sizeRow = $sizeResult->fetch_assoc()) {
                    $sizes[] = $sizeRow;
                }


                $crustStmt = $conn->prepare("SELECT name, price FROM crust");
                $crustStmt->execute();
                $crustResult = $crustStmt->get_result();


                $crust = [];
                while ($crustRow = $crustResult->fetch_assoc()) {
                    $crust[] = $crustRow;
                }


                ?>
                <div class="card">
                    <div class="row">
                        <h1 style="margin-top:20px;text-align:center;"><b><?= $row['name_pizza'] ?></b></h1>
                        <img src="<?= $row['image_pizza'] ?>" alt="pizza-pic" style="width:100%;">
                        <form action="/cart.php" method="post" style="margin-left:10rem;">
                            <label for="cart">
                                <h3>เลือกไซต์:</h3>
                            </label>
                            <select style="width:10rem;height:3rem;" name="cart" id="cart" onchange="calculateTotalPrice()">
                                <?php if (!empty($sizes)) {
                                    foreach ($sizes as $size) { ?>
                                        <option value="<?= $size['price'] ?>"><?= $size['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <br><br>

                            <label for="crust">
                                <h3>เลือกขอบพิซซ่า:</h3>
                            </label>
                            <select style="width:10rem;height:3rem;" name="crust" id="crust" onchange="calculateTotalPrice()">
                                <?php if (!empty($crust)) {
                                    foreach ($crust as $crustOption) { ?>
                                        <option value="<?= $crustOption['price'] ?>"><?= $crustOption['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <br><br>

                            <label for="quantity">
                                <h3>จำนวน:</h3>
                            </label>
                            <select style="width:10rem;height:3rem;" name="quantity" id="quantity" onchange="calculateTotalPrice()">
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?> ชิ้น</option>
                                <?php } ?>
                            </select>
                            <br><br>
                            <h1 style="margin-top:20px; margin-left:15rem;"><b><span id="totalPrice"><?= number_format($row['pizza_price'], 2) ?></span>บาท</b></h1>
                            <button type="button" class="btn btn-success" style="margin-top:10px;margin-bottom:30px; margin-left: 12rem;">
                                <h1> Add to cart</h1>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateTotalPrice() {

            var selectedSizePrice = parseFloat(document.getElementById("cart").value);
            var selectedCrustPrice = parseFloat(document.getElementById("crust").value);


            var pizzaPrice = parseFloat(<?= $row['pizza_price'] ?>);


            var totalPrice = pizzaPrice + selectedSizePrice + selectedCrustPrice;


            document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
        }
    </script>

</body>