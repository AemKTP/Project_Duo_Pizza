<?php
include "dbconn.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>pizza</title>
</head>
<nav>
    <?php
    include "nav_index.php";
    ?>
</nav>
<style>
    html,
    body {
        overflow-x: hidden;
    }

    .card {
        height: auto;
        border-radius: 20px;
    }

    .btn {
        border-radius: 12px;
        color: #fff;
        width: auto;
        height: 44px;
        display: flex;
        text-align: center;
        align-items: center;
    }
    .btn-search {
        border-radius: 100%;
        color: #fff;
        background-color: cornflowerblue;
        cursor: pointer;
        font-weight: 100;
        width: 15%;
        height: 30%;
        line-height: 1em;
        max-width: 100%;
        outline: none;
        padding: 10px;
        text-align: center;
        align-items: center;
    }
</style>


<!-- <article> -->
<header>

    <body style="height: 100%; min-height: 100vh;">
        <div class="row">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="https://cdn.1112.com/1112/public/images/banners/Sep23/sqaure_1440-th.jpg" class="w-100 d-block" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.1112.com/1112/public/images/banners/Sep23/BOGO_Coke_swensens_1440_TH.jpg" class="w-100 d-block" alt="Second slide">
                    </div>
                </div>
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
            </div>
        </div>
        <div>
</header>
<!-- </article> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<body>
    <h2 style="margin-top:34px; text-align: center;">เมนูพิซซ่า</h2>
    <div class="container">
        <div class="row">
            <?php
            $stmt = $conn->prepare("SELECT *
                                    from pizza");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) { ?>

                <div class="col-3" style="margin-bottom:3%;">
                    <div class="card">
                        <div class="row">

                            <h3 style="margin-top:20px;text-align:center;"><b><?= $row['name'] ?></b></h3>
                            <img src="<?= $row['image'] ?>" alt="pizza-pic" style="width:100%;">
                            <h5 style="margin-top:20px;text-align:center;"><b>*ราคาเริ่มต้น <?= $row['price'] ?></b></h5>

                            <div class="d-flex justify-content-center align-items-center">
                                <form action="login.php">
                                    <button type="submit" class="btn btn-warning" style="margin-bottom: 5px;">
                                        <h3>Login</h3>
                                    </button>
                                </form>
                                <form action="register.php">
                                    <button type="submit" class="btn btn-success" style="margin-left: 1rem; margin-bottom: 5px;">
                                        <h3>Register</h3>
                                    </button>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</body>

</html>