<?php
include 'dbconn.php';



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
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            display: flex;
            align-items: auto;
            justify-content: center;
            height: 300px;

        }

        .card-image {
            margin-top: 10px;
            display: flex;
            flex-direction: center;
            align-items: center;
            text-align: center;

        }

        .card-image img {
            width: auto;
            height: auto;
        }

        .card-title {
            text-align: auto;
        }

        .bgcolor {
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1) 0%, rgba(255, 144, 0, 1) 110%);
            transition: background-color 0.5s ease;
        }
    </style>
</head>

<body class="bgcolor">

    <?php
    $stmt = $conn->prepare("SELECT * FROM `order`, user where order.uid = user.uid ");
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col">
                <div class="col-3">

                    <select class="form-select form-select-lg mb-3 " name="type" style="margin-block: 2%;" onchange="this.form.submit()">
                        <option value="">เลือกทั้งหมด</option>
                    </select>
                </div>

                <?php while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="card">
                        <div class="row justify-content-between">
                            <div class="row center" style="margin-left: 2%; margin-right: 2%;">
                                <div class="col grid grid-cols-3 gap-5">
                                    <div class="">
                                        <h6>Order : <?= $row['oid'] ?></h6>
                                    </div>
                                </div>
                                <div class="col grid grid-cols-3 gap-5" style="display: flex;">
                                    <div>
                                        <h6>User : <?= $row['uid'] ?></h6>
                                        <h6>Name : <?= $row['name'] ?></h6>
                                        <h6>Phone : <?= $row['phone'] ?></h6>
                                        <h6>Email : <?= $row['email'] ?></h6>
                                    </div>
                                </div>
                                <div class="col grid grid-cols-3 gap-5">
                                    <div>
                                        <h6>address : <?= $row['oid'] ?></h6>
                                    </div>
                                </div>
                                <div class="col grid grid-cols-3 gap-5">
                                    <div>
                                        <h6>amount : <?= $row['oid'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>


</body>

</html>