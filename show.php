<!-- ยังไม่มี uid -->
<?php
include "dbconn.php";
error_reporting(E_ALL);

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
    // echo $uid;
    //$pid;

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

    a {
        text-decoration: none;
        color: black;
        transition: color 0.3s;
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

    .btn1 {
        border-radius: 20px;
        color: #fff;
        cursor: pointer;
        font-weight: 700;
        width: 10rem;
        height: 5rem;
        line-height: 1em;
        max-width: 100%;
        outline: none;
        padding: 10px;
        text-align: center;
        align-items: center;
    }

    .centercard {
        display: flex;
        height: 90vh;
        justify-content: center;
        align-items: center;

    }

    .input {
        background-color: lightgray;
        width: 90px;
        height: 50px;
    }

    .input[type="text"] {
        border-color: lightgray;
        border-radius: 10px;
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
                // $stmt = $conn->prepare("SELECT
                //     pizza.pid,
                //     pizza.name as name_pizza,
                //     pizza.image as image_pizza,
                //     pizza.price as pizza_price,
                //     crust.name as crust_name,
                //     size.price as size_price,
                //     size.name  as size_name,
                //     crust.price as crust_price
                //         FROM pizza
                //         INNER JOIN size ON pizza.sid = size.sid
                //         INNER JOIN crust ON pizza.cid = crust.cid
                //         WHERE pizza.pid = ?");
                // $stmt->bind_param('i', $pid);
                // $stmt->execute();
                // $result = $stmt->get_result();
                // $row = $result->fetch_assoc();

                $stmt = $conn->prepare("SELECT name as pizza_name , image as pizza_image , price as pizza_price
                                        FROM pizza
                                        WHERE pizza.pid = ?");
                $stmt->bind_param('i', $pid);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                $stmtSize = $conn->prepare("SELECT sid as size_sid, name as size_name, price as size_price
                                            FROM size");
                $stmtSize->execute();
                $resultSize = $stmtSize->get_result();
                // $rowSize = $resultSize->fetch_assoc();

                $sizes = [];
                while ($rowSize = $resultSize->fetch_assoc()) {
                    $sizes[] = $rowSize;
                }

                $stmtCrust = $conn->prepare("SELECT cid as crust_cid, name as crust_name, price as crust_price
                                            FROM crust");
                $stmtCrust->execute();
                $resultCrust = $stmtCrust->get_result();
                // $rowCrust = $resultCrust->fetch_assoc();


                $crust = [];
                while ($rowCrust = $resultCrust->fetch_assoc()) {
                    $crust[] = $rowCrust;
                }

                ?>
                <div class="card">
                    <div class="row">
                        <h1 style="margin-top:20px;text-align:center;"><b><?= $row['pizza_name'] ?></b></h1>
                        <img src="<?= $row['pizza_image'] ?>" alt="pizza-pic" style="width:100%;">
                        <form action="cart.php?uid=<?= $uid ?>&sid=<?= $_POST["size"] ?>&cid=<?= $_POST['crust'] ?>" method="post" style="margin-left:10rem;">
                            <label for="size">
                                <h3>เลือกไซต์:</h3>
                            </label>
                            <select style="width:10rem;height:3rem;" name="size" id="size" onchange="calculateTotalPrice()">
                                <?php if (!empty($sizes)) {
                                    foreach ($sizes as $size) { ?>
                                        <option value="<?= $size['size_price'] ?>,<?= $size['size_sid'] ?>"> <?= $size['size_name'] ?></option>
                                <?php
                                    }
                                } ?>

                            </select>
                            <br><br>

                            <label for="crust">
                                <h3>เลือกขอบพิซซ่า:</h3>
                            </label>
                            <select style="width:10rem;height:3rem;" name="crust" id="crust" onchange="calculateTotalPrice()">
                                <?php if (!empty($crust)) {
                                    foreach ($crust as $crustOption) { ?>
                                        <option value="<?= $crustOption['crust_price'] ?>,<?= $crustOption['crust_cid'] ?>"><?= $crustOption['crust_name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <br><br>

                            <div class="col-8" style="display: flex; justify-content: space-between;">
                                <label for="quantity" style="display: flex; justify-content: center; align-items: center;">
                                    <h3>จำนวน:</h3>
                                </label>
                                <span>
                                    <button type="button" class="btn1 btn-danger btn-number" data-type="minus" data-field="quantity">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input class="input" type="text" name="quantity" value="1" min="1" max="500" id="quantity" style="font-size: 20px; ">
                                <span>
                                    <button type="button" class="btn1 btn-success btn-number" data-type="plus" data-field="quantity">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                            <br><br>

                            <h1 style="margin-top:20px; margin-left:15rem;"><b><span id="totalPrice"><?= number_format($row['pizza_price'], 2) ?>
                                    </span>บาท</b></h1>

                            <!-- Add hidden input fields to send data -->
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="uid" value="<?= $uid ?>">
                            <input type="hidden" name="pid" value="<?= $pid ?>">
                            <input type="hidden" name="pizza_name" value="<?= $row['pizza_name'] ?>">
                            <input type="hidden" name="pizza_image" value="<?= $row['pizza_image'] ?>">
                            <input type="hidden" name="information" value="<?= $size['size_name'] . ' , ' . $crustOption['crust_name'] ?>">
                            <input type="hidden" name="pizza_price" value="<?= $row['pizza_price'] ?>">
                            <input type="hidden" name="size_price" id="size_price" value="0">
                            <input type="hidden" name="crust_price" id="crust_price" value="0">
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:30px; margin-left: 12rem; ">
                                <h1> Add to cart</h1>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(1);
                }

                // เพิ่มส่วนนี้เพื่อเปิดการใช้งานปุ่มที่ถูกปิดไว้
                $(".btn-number").removeAttr('disabled');
            });
        });
    </script>

    <script>
        function calculateTotalPrice() {

            var splitStringSize = document.getElementById("size").value.split(",");
            var priceSize = splitStringSize[0];

            var splitStringCrust = document.getElementById("crust").value.split(",");
            var priceCrust = splitStringCrust[0];

            // var selectedCrustPrice = parseFloat(document.getElementById("size").value);
            var selectedSizePrice = parseFloat(priceSize);
            var selectedCrustPrice = parseFloat(priceCrust);

            var pizzaPrice = parseFloat(<?= $row['pizza_price'] ?>);

            var totalPrice = pizzaPrice + selectedSizePrice + selectedCrustPrice;

            document.getElementById("total_price").value = totalPrice.toFixed(2);

            document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
        }
        calculateTotalPrice();
    </script>
</body>